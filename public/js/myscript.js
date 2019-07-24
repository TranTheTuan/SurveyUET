var answer_input = `<div class="form-group input-field input-g">
    <label for="choice">Options</label>
    <input type="text" class="form-control" id="choice[]" name="choice[]" required>
    <span class="text-danger delete-option" style="float:right; cursor:pointer;">Delete</span>
    <span class="text-primary add-option" style="cursor:pointer;">Add Option</span>
    </div>`;

$('#select-type').change(function () {
    var selected_option = $('#select-type :selected').val();
    if (selected_option === "1" || selected_option === "2") {
        $('.answer-field').html(answer_input);
    } else {
        $(".input-g").remove();
    }
});

$(document).on('click', '.add-option', function () {
    console.log('clicked add');
    $('.answer-field').append(answer_input);
});

$(document).on('click', '.delete-option', function () {
    console.log('deleted add');
    $(this).parent(".input-field").remove();
});
