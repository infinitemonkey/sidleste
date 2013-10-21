var newTaskForm = '#newTaskForm';
var taskTemplate = '#taskTemplate';
var tasksContent = '#tasksContent';
var storageId = 'tuduu';
var listId = 'tuduuList';
var outputDateFormat = 'dd.MM.yyyy';

//***********************************************
//*******          Init-Methods          ********
//***********************************************
$(document).ready(function () {
    $(newTaskForm).submit(function (e) {
        e.preventDefault();
        var obj = $(this).serializeObject();
        if (obj.task == '') {
            $('#task').focus();
            $('#task').parent().addClass('error');
            return;
        } else {
            $('#task').parent().removeClass('error');
        }
        if (obj.date == '') {
            obj.date = formatDate(new Date(), outputDateFormat);
        }
        var nextId = localStorage.getItem(listId);
        if (nextId == null) {
            nextId = 0;
        }
        obj.id = ++nextId;
        obj.done = 'false';
        list.push(obj);
        localStorage.setItem(listId, nextId);
        saveTasks(list);
        updateList(list);
        $(this)[0].reset();
    });

    $('#contact').on('shown', function () {
        $('input', this)[0].focus();
    });

    var list = getTasks();
    if (list != null) {
        updateList(list);
    } else {
        list = [];
    }

    $('#date').datepicker({
        inline: true
    });

    //$('#content').show(2000);
});


//***********************************************
//*******         Tasks-Methods          ********
//***********************************************
function udpateTask(array, property, value, key, newValue) {
    $.each(array, function (index, result) {
        if (result && result[property] == value) {
            result[key] = newValue;
            return false;
        }
    });
    return array;
}

function deleteTask(array, property, value) {
    $.each(array, function (index, result) {
        if (result && result[property] == value) {
            array.splice(index, 1);
            return false;
        }
    });
}

function clearList() {
    $(tasksContent).html('');
}

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function updateList(list) {
	clearList();
	list.sort(function(a, b) { return compareDates(a.date, outputDateFormat, b.date, outputDateFormat); } );
	$(taskTemplate).tmpl(list).appendTo(tasksContent);

    // Delete a task
	$('span.btn.btn-danger').click(function (e) {
	    e.preventDefault();
	    var id = $(this).data('obj-id');
	    deleteTask(list, 'id', id);
	    saveTasks(list);
	    $(this).parent().parent().hide(1000);
	});

    // Set a task as finished
	$('span.btn.btn-success').click(function(e) {
		e.preventDefault();
		var id = $(this).data('obj-id');
		list = udpateTask(list, 'id', id, 'done', 'true');
		saveTasks(list);
		updateList(list);
	});
}

function saveTasks(list) {
	localStorage.removeItem(storageId);
	if (list != null && list.length > 0) {
		localStorage.setItem(storageId, JSON.stringify(list));
	}
}

function getTasks() {
    return JSON.parse(localStorage.getItem(storageId));
}