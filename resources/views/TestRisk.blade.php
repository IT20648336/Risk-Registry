@include('layouts.header')

    <title>CATEGORIES</title>
    <header>
    <script src="{{ asset('js/Category.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        /* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  border: 1px solid #888;
  width: 25%;
  height: 50%;
    }
.close {
  color: #fff;
  float: right;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  background-color: #000;
  border-radius: 50%;
  padding: 5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 15px;
  margin-left: 90%;
}

.close:hover,
.close:focus {
 background-color: #555;
 color: #fff;
 text-decoration: none;
 cursor: pointer;
}
    
.hidden {
  display: none;
}
select {
  display: block;
  width: 100%;
  padding: 8px;
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  border: 1px solid #CCC;
  border-radius: 4px;
  background-color: #F2F2F2;
  color: #4A3B94;
}

select option {
  padding: 5px;
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  color: #4A3B94;
}

select option[value=""] {
  color: #888;
}
    </style>
</header>
<body>

<h2 style="color:#4A3B94;position:absolute;left:285px;font-size:15px;" align="right">Risk Category</h2>

<table style="width: 90%;height: auto;margin: 0px auto; margin-left:auto; border: hidden; margin-top:30px;">
    <thead>
        <tr>
            <th><h4>Risk Category</h4></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category => $subcategories)
            @php
                $hasSubcategories = $subcategories->count() > 1;
            @endphp
            <tr>
                <td>
                    <form class="edit-form" method="POST" action="{{ route('update.category') }}">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $subcategories[0]->Category_Id }}">
                         <h4 class="category-text" style="font-weight: bold;">{{ $category }}</h4>
                        <input type="text" name="category" value="{{ $category }}" class="edit-input" style="display: none;">
                    </form>
                </td>
                <td>
                    <button class="edit-button">Edit</button>
                    <button class="save-button">Save</button>
                </td>
                <td style="display:none;">{{ $subcategories[0]->Category_Id }}</td>
            </tr>
            @foreach ($subcategories as $index => $subcategory)
                <tr class="subcategory-row" style="display: none;">
                    <td colspan="2">
                     <form class="edit-form-subcategory" method="POST" action="{{ route('update.subcategory') }}">
                            @csrf
                            
                            <input type="hidden" name="subcategory_id" value="{{ $subcategory->Id }}">
                            <input type="text" name="subcategory" value="{{ $subcategory->Sub_Category }}" class="edit-input-subcategory" style="display: none;">
                            <span class="subcategory-text">{{ $subcategory->Sub_Category }}</span>
                     </form>
                   </td>  
                   <td>
                        <button class="edit-subcategory-button" >Edit</button>
                        <button class="save-subcategory-button">Save</button>
                   </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

<!-- Popup Modal -->
<div id="addModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
          <!--<p class="CategorySelecText">Category Selection</p>-->
          <h4 class="CategoryText"> Add New Category</h4>
          <h4 class="CategorySelecText">Category Selecetion</h4>
        <form id="categoryForm" action="{{ route('saveCategory') }}" method="POST">
            @csrf

            <label class="CategiryRadio1">
                <input type="radio" name="categoryType" value="risk"> Risk Category
            </label>
            <label  class="CategiryRadio2">
                <input type="radio" name="categoryType" value="sub"> Sub Category
            </label>

            <div id="riskCategoryInput" style="display: none;">
                <label for="riskCategoryName" class ="riskCategoryName">Risk Category Name:</label>
                <input type="text" id="riskCategoryName" name="riskCategoryName" style="margin-top:20%;">
            </div>

            <div id="subCategoryInput" style="display: none;">
            <label for="dropdown">Risk Category Name:</label>
                <select id="dropdown" name="dropdown">
                    <option value="">Select a Category</option>
                    @foreach($categories as $category => $subCategories)
                        <option value="{{ $category }}" data-category-id="{{ $subCategories[0]->Category_Id }}">{{ $category }}</option>
                    @endforeach
                </select>
                <label for="subCategoryName">Sub Category Name:</label>
                <input type="text" id="subCategoryName" name="subCategoryName" style="width:100%;">
                <br>
            </div>

          <div id="categoryIDField" style="display: none;">
              <label for="categoryID" style="display: none;">Category ID:</label>
              <span id="categoryID" name="categoryID" style="display: none;"></span>
          </div>
            <button type="button" id="cancelAdd">CANCEL</button>
            <button type="submit" id="saveAdd">Save</button>
        </form>
    </div>
</div>

<button id="addButton" class="categoryBtn">+    Add New Category</button>
</body>
</html>