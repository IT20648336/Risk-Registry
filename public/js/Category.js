$(document).ready(function() {
    $(".edit-button").click(function() {
        var row = $(this).closest("tr");
        var categoryText = row.find(".category-text");
        var editInput = row.find(".edit-input");
        var editButton = row.find(".edit-button");
        var saveButton = row.find(".save-button");

        categoryText.hide();
        editInput.show();
        editButton.hide();
        saveButton.show();
    });

    $(".save-button").click(function() {
        var row = $(this).closest("tr");
        var categoryText = row.find(".category-text");
        var editInput = row.find(".edit-input");
        var editButton = row.find(".edit-button");
        var saveButton = row.find(".save-button");
        var newCategory = editInput.val();
        var categoryId = row.find("input[name='category_id']").val();
        $.ajax({
            url: "/update-category",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: { category: newCategory, category_id: categoryId },
            success: function(response) {
                categoryText.text(newCategory);
                categoryText.show();
                editInput.hide();
                editButton.show();
                saveButton.show();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $(".edit-subcategory-button").click(function() {
        var row = $(this).closest("tr");
        var subcategoryText = row.find(".subcategory-text");
        var editSubcategoryInput = row.find(".edit-input-subcategory");
        var editSubcategoryButton = row.find(".edit-subcategory-button");
        var saveSubcategoryButton = row.find(".save-subcategory-button");

        subcategoryText.hide();
        editSubcategoryInput.show();
        editSubcategoryButton.hide();
        saveSubcategoryButton.show();
    });

    $(".save-subcategory-button").click(function() {
        var row = $(this).closest("tr");
        var subcategoryText = row.find(".subcategory-text");
        var editSubcategoryInput = row.find(".edit-input-subcategory");
        var editSubcategoryButton = row.find(".edit-subcategory-button");
        var saveSubcategoryButton = row.find(".save-subcategory-button");
        var newSubcategory = editSubcategoryInput.val();
        var subcategoryId = row.find("input[name='subcategory_id']").val();
        $.ajax({
            url: "/update-subcategory",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: { subcategory: newSubcategory, subcategory_id: subcategoryId },
            success: function(response) {
                subcategoryText.text(newSubcategory);
                subcategoryText.show();
                editSubcategoryInput.hide();
                editSubcategoryButton.show();
                saveSubcategoryButton.show();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $(".category-text").click(function() {
        var row = $(this).closest("tr");
        var subcategoryRows = row.nextUntil(":not(.subcategory-row)");

        if (subcategoryRows.is(":visible")) {
            subcategoryRows.hide();
        } else {
            subcategoryRows.show();
        }
    });
});

    $(document).ready(function() {
        $('#addButton').click(function() {
            $('#addModal').fadeIn();
        });

        $('.close').click(function() {
            $('#addModal').fadeOut();
        });

        $('#cancelAdd').click(function() {
            $('#addModal').fadeOut();
        });

    $('#categoryForm').submit(function(event) {
        event.preventDefault();

        var categoryType = $('input[name="categoryType"]:checked').val();
        var riskCategoryName = $('#riskCategoryName').val();
        var subCategoryName = $('#subCategoryName').val();
        var dropdownValue = $('#dropdown').val();
        var categoryID = $('#categoryID').text(); 
        var selectedCategory = $('#dropdown option:selected').val(); 

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: {
                _token: $(this).find('input[name="_token"]').val(),
                categoryType: categoryType,
                riskCategoryName: riskCategoryName,
                subCategoryName: subCategoryName,
                dropdownValue: dropdownValue,
                categoryID: categoryID, 
                selectedCategory: selectedCategory 
            },
            success: function(response) {
                if (categoryType === 'risk') {
                    swal({
                        type: 'success',
                        title: 'New Category',
                        text: 'Category Added Successfully !'
                    }).then(function() {
                        location.reload();
                    });
                } else if (categoryType === 'sub') {
                    swal({
                        type: 'success',
                        title: 'New Subcategory',
                        text: 'Subcategory Added Successfully !'
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                swal({
                    type: 'error',
                    title: 'Oops!',
                    text: 'Save failed!'
                });
            }
        });
    });
    $('input[name="categoryType"]').change(function() {
        if ($(this).val() === 'risk') {
            $('#riskCategoryInput').show();
            $('#subCategoryInput').hide();
            $('#categoryIDField').hide(); 
            $('#riskCategoryName').prop('required', true); 
            $('#subCategoryName').prop('required', false); 
            $('#dropdown').prop('required', false);
        } else {
            $('#riskCategoryInput').hide();
            $('#subCategoryInput').show();
            $('#dropdown').change();
            $('#riskCategoryName').prop('required', false);
            $('#subCategoryName').prop('required', true);
            $('#dropdown').prop('required', true);
        }
    });

        $('input[name="categoryType"]').change();

    $('#dropdown').change(function() {
        var selectedCategoryId = $(this).find('option:selected').data('category-id');
        $('#categoryID').text(selectedCategoryId);
        $('#categoryIDField').show();
        $('#riskCategoryName').prop('required', false);
    });
});

//REMINDER EMAIL SCRIPT
 
        tinymce.init({
            selector: '#emailBody'
        });

        $(document).ready(function() {
            var selectedUsers = [];

            function updateUserCount() {
                $("#selected_users_count").text(selectedUsers.length);
            }

            function updateDivisionCount() {
                var selectedDivisions = $.map(selectedUsers, function(user) {
                    return user.division;
                });
                var uniqueDivisions = [...new Set(selectedDivisions)];
                $("#selected_divisions_count").text(uniqueDivisions.length);
            }

            function addUser(user) {
                var tr = $("<tr>", { "data-division": user.division });
                tr.append($("<td>").html("<h4>" + user.name + "</h4>"));
                tr.append($("<td>").html("<h4>" + user.division + "</h4>"));
                tr.append($("<td>").html("<h4>" + user.email + "</h4>"));
                tr.append($("<td>").html("<h4>" + user.mobile + "</h4>"));
                tr.append($("<td>").html("<button class='btn btn-danger btn-sm btn-remove'>Remove</button>"));
                $(".tbody-wrapper1").append(tr);
            }

function removeUser(index) {
    var user = selectedUsers[index];
    var division = user.division;
    var name = user.name;
    selectedUsers.splice(index, 1);

    // Uncheck the corresponding row in the user table
    $(".tbody-wrapper tr[data-division='" + division + "'][data-name='" + name + "']").find("input[type=checkbox]").prop("checked", false);

    // Remove the row from the second table
    $(".tbody-wrapper1 tr").eq(index).remove();

    updateUserCount();
    updateDivisionCount();
}

$(document).on("click", ".btn-remove", function() {
    var $row = $(this).closest("tr");
    var index = $row.index();
    
    // Check if the row exists in the user table
    var division = $row.attr("data-division");
    var name = $row.find("td:eq(0)").text();
    var $checkbox = $(".tbody-wrapper tr[data-division='" + division + "'][data-name='" + name + "']").find("input[type=checkbox]");
    
    if ($checkbox.length > 0) {
        $checkbox.prop("checked", false);
    }
    
    // Remove the row from the second table
    $row.remove();

    removeUser(index);
});


            $("#division_select").change(function() {
                var selectedDivision = $(this).val();
                $(".tbody-wrapper tr").hide();
                if (selectedDivision) {
                    $(".tbody-wrapper tr[data-division='" + selectedDivision + "']").show();
                } else {
                    $(".tbody-wrapper tr").show();
                }
            });

            $(".tbody-wrapper").on("change", "input[type=checkbox]", function() {
                var tr = $(this).closest("tr");
                var isChecked = $(this).is(":checked");
                var name = tr.find("td:eq(1)").text();
                var division = tr.find("td:eq(2)").text();
                var email = tr.find("td:eq(3)").text();
                var mobile = tr.find("td:eq(4)").text();
                if (isChecked) {
                    selectedUsers.push({
                        name: name,
                        division: division,
                        email: email,
                        mobile: mobile
                    });
                    addUser({
                        name: name,
                        division: division,
                        email: email,
                        mobile: mobile
                    });
                } else {
                    var index = selectedUsers.findIndex(function(user) {
                        return user.name === name && user.division === division;
                    });
                    if (index > -1) {
                        removeUser(index);
                    }
                }
                updateUserCount();
                updateDivisionCount();
            });

            $(".tbody-wrapper1").on("click", ".btn-remove", function() {
                var index = $(this).closest("tr").index();
                removeUser(index);
            });
        
        $("#emailbtn").click(function() {
            swal({
                title: 'Sending Email',
                text: 'Please wait...',
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
                icon: 'info'
            });
        
            var emailSubject = $("#emailSubject").val();
            var emailBody = tinymce.activeEditor.getContent();
        
            sendEmails(selectedUsers, emailSubject, emailBody);
        });
        
        function sendEmails(users, subject, body) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var emailData = {
                _token: csrfToken,
                users: users,
                subject: subject,
                body: body,
            };
        
            $.ajax({
                url: "/send-emails",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: emailData
            })
            .done(function(response) {
                setTimeout(function() {
                    swal.close();
                    swal({
                        title: 'Reminder Email',
                        text: 'Email Sent Successfully!',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                    });
                }, 500);
            })
            .fail(function(xhr, status, error) {
                swal.close();
        
                var errorMessage = xhr.responseText;
                swal({
                    type: 'error',
                    title: 'Oops!',
                    text: errorMessage
                });
            });
        }
        });