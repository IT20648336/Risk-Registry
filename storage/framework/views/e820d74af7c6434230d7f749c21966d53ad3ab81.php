<title>Categories</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<header>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19"></script>
<style>





</style>

</header>



<h2 style="color:#4A3B94;position:absolute;left:285px";align="right">RISK CATEGORY</h2>

<form method="post" align="center" enctype="multipart/form-data" id="RiskData">
    <div align="right"> 
        <input class="button" style="height: 25px;" type="button" value="+ Add New Category" data-toggle="modal" data-target="#AddNewUser" onclick="GetDivisionDataUser('GetDivisionDataUser'); return false;">
    </div>

<!-- Add New Category Modal -->
<div class="modal fade" id="AddNewUser" tabindex="-1" role="dialog" aria-labelledby="AddNewUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddNewUserLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo e(route('risk-category.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="categoryType">Category Type:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryType" id="categoryTypeRisk" value="risk" checked onclick="toggleCategoryFields()">
                            <label class="form-check-label" for="categoryTypeRisk">Risk Category</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryType" id="categoryTypeSubRisk" value="subrisk" onclick="toggleCategoryFields()">
                            <label class="form-check-label" for="categoryTypeSubRisk">Sub-Risk Category</label>
                        </div>
                    </div>
                    <div class="form-group" id="riskCategoryField">
                        <label for="category">Category:</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="form-group" id="subRiskCategoryField" style="display: none;">
                        <label for="subRiskCategory">Sub-Risk Category:</label>
                        <input type="text" class="form-control" id="subRiskCategory" name="subRiskCategory" required>
                    </div>
                    <div class="form-group" id="riskCategoryDropdown" style="display: none;">
                        <label for="riskCategory">Risk Category:</label>
                        <select class="form-control" id="riskCategory" name="riskCategory">
                            <!-- Add options for risk categories here -->
                            <option value="riskCategory1">Risk Category 1</option>
                            <option value="riskCategory2">Risk Category 2</option>
                            <option value="riskCategory3">Risk Category 3</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>







<!-- Edit Category Modal -->

<div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="EditUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditUserLabel">Edit Risk Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form method="post" action="<?php echo e(route('risk-category.update')); ?>" id="editForm">

                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" id="editKey">
                    <div class="form-group">
                        <label for="editCategory">Category:</label>
                        <input type="text" class="form-control" id="editCategory" name="category" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>



    <br>
    <div class="trhover">
        <?php echo csrf_field(); ?>
        <table>
            <tr>
                <th>
                    <h5>RISK CATEGORY</h5>
                </th>
                <th>
                    <h5></h5>
                </th>
                <th>
                    <h5>STATUS</h5>
                </th>
            </tr>
 
         <?php $__currentLoopData = $Category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <?php

if ($data->Status == 'Active'):
$Status_Color='#DFFFE2';
$Status_Font_Color='#009F0C';
elseif ($data->Status == 'Inactive'):
$Status_Color='#FFEEE6';
$Status_Font_Color='#903000';
else:
$Status_Color='#ECECEC';
$Status_Font_Color='#242424';
endif;


?>
     
    <tr>
     
       <td>
       <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo e($data->Category); ?></a>
        <ul class="collapse list-unstyled" id="pageSubmenu1">
          <li>
             <li class="subcategory-dropdown" data-category="<?php echo e($data->Category); ?> " >
          </li>
        
        </li>
        </ul>
</td>
        
        <td>
             <button class="button" style="height: 20px; margin-top: 1px;" type="button" onclick="openEditModal('<?php echo e($data->Id); ?>', '<?php echo e($data->Category); ?>')">EDIT</button>
            
        </td>
        <td>
        <label class="switch">
    <?php if($data->Status  == 'Active'): ?>
    <input type="checkbox"  checked onchange="changeRiskStatus('changeRiskStatus?Id=<?php echo e($data->Id); ?>&NextStatus=Inactive'); return false;" >
    <?php elseif($data->Status  == 'Inactive'): ?>
    <input type="checkbox"  onchange="changeRiskStatus('changeRiskStatus?Id=<?php echo e($data->Id); ?>&NextStatus=Active'); return false;" >
    <?php endif; ?>       
    <span  class="slider"></span>
    </label>
 
  
 
</td>



    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>

<script>
    // Function to open the edit modal with pre-filled data
    function openEditModal(key, category) {
        // Set the key and category values in the edit modal form
        document.getElementById('editKey').value = key;
        document.getElementById('editCategory').value = category;
        
        // Open the edit modal
        $('#EditUser').modal('show');
    }
    
    // Submit the edit form
    $('#editForm').submit(function(e) {
        e.preventDefault();
        
        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response) {
                if (response.success) {
                    // Close the edit modal
                    $('#EditUser').modal('hide');
                    
                    // Show success notification
                    showNotification('Risk Category Updated', 'success');
                } else {
                    // Show error notification
                    showNotification('Failed to Update Risk Category', 'error');
                }
            },
            error: function(error) {
                console.error('An error occurred:', error);
                // Show error notification
                showNotification('An error occurred', 'error');
            }
        });
    });
</script>








<script>
    // Function to populate subcategory dropdowns
    function populateSubcategoryDropdowns() {
        // Get all subcategory dropdowns
        var dropdowns = document.getElementsByClassName('subcategory-dropdown');
        
        // Iterate over each dropdown
        Array.from(dropdowns).forEach(function(dropdown) {
            var category = dropdown.getAttribute('data-category');
            
            // Fetch subcategories based on category
            fetch('<?php echo e(route('risk-category.subcategories')); ?>?category=' + category)
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    dropdown.innerHTML = '<option value=""></option>';
                    
                    // Add subcategories as options
                    data.forEach(function(subcategory) {
                        var option = document.createElement('option');
                        option.value = subcategory;
                        option.text = subcategory;
                        dropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('An error occurred:', error);
                });
        });
    }

    // Call the function to populate subcategory dropdowns on page load
    populateSubcategoryDropdowns();
</script>


<script>
$(function() {
    $('#DataTableId thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#DataTableId thead');

    var table = $('#DataTableId').DataTable({
        serverSide: true,
        ajax: {
            url: 'RiskDataList',
            data: function (d) {
                $('.filters input').each(function() {
                    d.columns[$(this).parent().index()].search.value = this.value;
                });
            }
        },
        columns: [
            {data: 'RISK CATEGORY', name: 'Category',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
         
            {data: 'STATUS', name: 'Status',
              render: function (data) {
              var Color;
              var ColorFont;
              switch (data) {
                  case 'Active':
                      Color = '#FFE3E3';
                      ColorFont = '#CB0000';
                      break;
                  case 'Inactive':
                      Color = '#E6E8FF';
                      ColorFont = '#000D91';
                      break;
                  default:
                      Color = '#EEEEEE';
                      ColorFont = '#000000';
              }
                return '<div style="background-color:'+ Color +'; font-weight: bold; border-radius: 4px; padding: 0px 0px 0px 0px; width:auto; display: inline-block; color:#FFFFFF;text-align: center;font-size:12px; color:'+ColorFont+';">&nbsp;'+ data +'&nbsp;</div';               
            }
            },
            {
            data: 'RowId', name: 'Id',
            render: function (RowId){
            return '<input class="button" data-toggle="modal" data-target="#Electricity_Consumption_Feedback_Form" style="width:auto; display: inline-block; height: 20px; padding: 0px 5px 5px 5px; border-radius: 5px; font-size: 12px; text-align: center; background-color: #015484;" type="button" value="Feedback" onclick=ElectricityConsumptionFeedback("ElectricityConsumptionFeedback?RowId='+RowId+'"); return false;" />';  
            }
            }
        ],
        order: [[0, 'asc']],
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) {
                var cell = $('.filters th').eq(
                    $(api.column(colIdx).header()).index()
                );
                var title = $(cell).text();
                $(cell).html('<input style="height:20px; border-radius: 3px;" type="text" />');
                $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                    .off('keyup change')
                    .on('keyup change', function (e) {
                        table.draw();
                    });
            });
        }
    });
});
</script><?php /**PATH /data/RiskRegistry/resources/views/RiskCategory/RiskCategory.blade.php ENDPATH**/ ?>