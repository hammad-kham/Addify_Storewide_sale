@extends('shopify-app::layouts.default')

@section('content')
<section>
        <div class="card">
                <div class="row">
                        <div class="columns eight">
                                <h2 class="card-header">Addify Storewide Sale</h2>
                        </div>
                        
                </div>
                <div class="row" style="display: flex; justify-content: flex-end; align-items: center; width: 98%; margin-right:50px;">
                        <button class="button warning" style="margin-right: 10px;">Change Plan</button>
                        <button style="background-color: #ccb75c; color: white; cursor: pointer;">
                                Guide
                        </button>
                </div>
                    
                    

                <div class="columns has-sections">
                        <!-- Tabs Navigation -->
                        <ul class="tabs">
                                <li class="tab-item active"><a href="#" data-tab="general">General Settings</a></li>
                                <li class="tab-item"><a href="#" data-tab="restriction">Role Restrictions</a></li>
                                <li class="tab-item"><a href="#" data-tab="notification">Notification Settings</a></li>
                        </ul>


                        <!-- Tabs Content -->
                        <div class="card-section">
                                <div id="general" class="tab-content active">
                                        <div class="card">
                                                <form id="sale-general-form">
                                                        <h3 class="card-header">Storewide Settings & Sale Details</h3>
                                                        <div class="card-body">

                                                                <!-- Enable Storewide Sale -->
                                                                <div class="card">
                                                                        <div class="row">
                                                                                <label class="columns five">Enable
                                                                                        Storewide Sale</label>
                                                                                <div class="columns seven">
                                                                                        <select name="storewide_sale"
                                                                                                class="input select2"
                                                                                                style="">
                                                                                                <option value="1">✅
                                                                                                        Enable</option>
                                                                                                <option value="0">❌
                                                                                                        Disable</option>
                                                                                        </select>
                                                                                </div>
                                                                        </div>


                                                                        <div class="columns twelve"
                                                                                style="text-align: right; margin-top:20px">
                                                                                <button class="btn primary">Save
                                                                                        Changes</button>
                                                                        </div>

                                                                </div>


                                                               


                                                        </div>
                                                </form>
                                        </div>
                                </div>



                                <!-- Role Restrictions Tab -->
                                <div id="restriction" class="tab-content" style="display: none;">

                                        <!-- Sale Details Card -->
                                        <div class="card">
                                                <div class="card-header text-center" style="margin: 10px 0">
                                                        <b>Sale Details</b>
                                                </div>
                                                <div class="card-body">
                                                        <form id="sale-details-form">
                                                                <!-- Sale Type -->
                                                                <div class="row">
                                                                        <label class="columns four">Sale Type</label>
                                                                        <div class="columns eight">
                                                                                <label><input type="radio"
                                                                                                name="sale_type"
                                                                                                checked> Percentage
                                                                                        (%)</label>
                                                                                <label class="ml-3"><input type="radio"
                                                                                                name="sale_type">
                                                                                        Fixed</label>
                                                                        </div>
                                                                </div>

                                                                <!-- Sale Amount -->
                                                                <div class="row">
                                                                        <label class="columns four">Sale Amount</label>
                                                                        <div class="columns eight">
                                                                                <input type="text"
                                                                                        placeholder="Enter sale amount"
                                                                                        class="input"
                                                                                        style="width: 100%; padding: 10px;">
                                                                        </div>
                                                                </div>

                                                                <!-- Sale Start -->
                                                                <div class="row"
                                                                        style="display: flex; align-items: center; margin-bottom: 15px;">
                                                                        <label class="columns four">Sale Start</label>
                                                                        <div class="columns four"
                                                                                style="margin-right: 6px;">
                                                                                <input type="date" class="input"
                                                                                        style="width: 90%; padding: 10px;">
                                                                        </div>
                                                                        <div class="columns four">
                                                                                <input type="time" class="input"
                                                                                        style="width: 90%; padding: 10px;">
                                                                        </div>
                                                                </div>

                                                                <!-- Sale End -->
                                                                <div class="row"
                                                                        style="display: flex; align-items: center; margin-bottom: 15px;">
                                                                        <label class="columns four">Sale End</label>
                                                                        <div class="columns four"
                                                                                style="margin-right: 6px;">
                                                                                <input type="date" class="input"
                                                                                        style="width: 90%; padding: 10px;">
                                                                        </div>
                                                                        <div class="columns four">
                                                                                <input type="time" class="input"
                                                                                        style="width: 90%; padding: 10px;">
                                                                        </div>
                                                                </div>


                                                        </form>
                                                </div>
                                        </div>

                                        <!-- User Selection Card -->
                                        <div class="card">
                                                <div class="card-header" style="margin: 10px 0">
                                                        <b>User Restrictions</b>
                                                </div>
                                                <div class="card-body">
                                                        <!-- Guest -->
                                                        <div class="row">
                                                                <label class="columns four">Guest</label>
                                                                <div class="columns eight">
                                                                        <input type="checkbox" checked>
                                                                </div>
                                                        </div>

                                                        <!-- Users Selection -->
                                                        <div class="row">
                                                                <label class="columns four">Users</label>
                                                                <div class="columns eight">
                                                                        <label><input type="radio" name="user_selection"
                                                                                        value="all" checked> All
                                                                                Users</label>
                                                                        <label class="ml-3"><input type="radio"
                                                                                        name="user_selection"
                                                                                        value="specific"> Specific
                                                                                Users</label>
                                                                </div>
                                                        </div>

                                                        <!-- Specific User Tags Dropdown (Only One Dropdown) -->
                                                        <div class="row" id="specific-user-tags-container"
                                                                style="display: none;">
                                                                <label class="columns four">Specific User Tags</label>
                                                                <div class="columns eight">
                                                                        <select id="specific-user-tags"
                                                                                class="input select2"
                                                                                multiple="multiple" style="width: 100%;"
                                                                                placeholder="Search user tags..."></select>
                                                                </div>
                                                        </div>


                                                </div>
                                        </div>

                                        <!-- Product Selection Card -->
                                        <div class="card">
                                                <div class="card-header" style="margin: 10px 0">
                                                        <b>Product Selection</b>
                                                </div>
                                                <div class="card-body">
                                                        <div class="row">
                                                                <label class="columns four">Include Products</label>
                                                                <div class="columns eight">
                                                                        <label><input type="radio"
                                                                                        name="product_selection"
                                                                                        value="all" checked> All
                                                                                Products</label>
                                                                        <label class="ml-3"><input type="radio"
                                                                                        name="product_selection"
                                                                                        value="specific"> Specific
                                                                                Products</label>
                                                                </div>
                                                        </div>

                                                        <div id="specific-selection-container" style="display: none;">

                                                                <!-- Specific Products -->
                                                                <div class="row">
                                                                        <label class="columns four">Specific
                                                                                Products</label>
                                                                        <div class="columns eight">
                                                                                <select id="specific-products"
                                                                                        class="input select2"
                                                                                        multiple="multiple"
                                                                                        style="width: 100%;"
                                                                                        placeholder="Search products..."></select>
                                                                        </div>
                                                                </div>

                                                                <!-- Collections -->
                                                                <div class="row">
                                                                        <label class="columns four">Include
                                                                                Collections</label>
                                                                        <div class="columns eight">
                                                                                <select id="specific-collections"
                                                                                        class="input select2"
                                                                                        multiple="multiple"
                                                                                        style="width: 100%;"
                                                                                        placeholder="Search collections..."></select>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                        <!-- Product Tags Card -->
                                        <div class="card">
                                                <div class="card-header" style="margin: 10px 0">
                                                        <b>Product Tags</b>
                                                </div>
                                                <div class="card-body">
                                                        <div class="row">
                                                                <label class="columns four">Product Tags</label>
                                                                <div class="columns eight">
                                                                        <select id="product-tags" class="input select2"
                                                                                multiple="multiple" style="width: 100%;"
                                                                                placeholder="Search or add tags..."></select>
                                                                </div>
                                                        </div>
                                                </div>


                                                <div class="columns twelve"
                                                style="text-align: right; margin-top:20px">
                                                <button class="btn primary">Save
                                                        Changes</button>
                                        </div>
                                        </div>

                                        
                                       

                                </div>


                                <!-- Notification Settings Tab -->
                                <div id="notification" class="tab-content" style="display: none;">

                                        <!-- Top Bar Notification Settings Card -->
                                        <div class="card mb-3">
                                                <div class="card-header text-center">
                                                        <b>Top Bar Notification Settings</b>
                                                </div>
                                                <div class="card-body">
                                                        <form id="notification-form">
                                                                <div class="row mb-3">
                                                                        <label class="columns five">Enable Storewide
                                                                                Topbar Sale Notification</label>
                                                                        <div class="columns seven">
                                                                                <select name="topbar_sale_notification"
                                                                                        class="input select2">
                                                                                        <option value="1">✅ Enable
                                                                                        </option>
                                                                                        <option value="0">❌ Disable
                                                                                        </option>
                                                                                </select>
                                                                        </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                        <label class="columns five">Notification
                                                                                Content</label>
                                                                        <div class="columns seven">
                                                                                <input type="text"
                                                                                        value="Hey! Enjoy 20% off on Hoodies"
                                                                                        class="input">
                                                                        </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                        <label class="columns five">Notification
                                                                                Background Color</label>
                                                                        <div class="columns seven">
                                                                                <input type="color" value="#FF00FF">
                                                                        </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                        <label class="columns five">Notification Font
                                                                                Color</label>
                                                                        <div class="columns seven">
                                                                                <input type="color" value="#CCCCCC">
                                                                        </div>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>

                                        <!-- Popup Notification Settings Card -->
                                        <div class="card mb-3">
                                                <div class="card-header text-center">
                                                        <b>Popup Notification Settings</b>
                                                </div>
                                                <div class="card-body">
                                                        <div class="row mb-3">
                                                                <label class="columns five">Enable Storewide Popup
                                                                        Notification</label>
                                                                <div class="columns seven">
                                                                        <select name="popup_sale_notification"
                                                                                class="input select2">
                                                                                <option value="1">✅ Enable</option>
                                                                                <option value="0">❌ Disable</option>
                                                                        </select>
                                                                </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                                <label class="columns five">Popup Content</label>
                                                                <div class="columns seven">
                                                                        <input type="text"
                                                                                value="🔥 Special Discount Just for You!"
                                                                                class="input">
                                                                </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                                <label class="columns five">Popup Background
                                                                        Color</label>
                                                                <div class="columns seven">
                                                                        <input type="color" value="#00CC00">
                                                                </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                                <label class="columns five">Popup Font Color</label>
                                                                <div class="columns seven">
                                                                        <input type="color" value="#CCCCCC">
                                                                </div>
                                                        </div>
                                                </div>


                                                <div class="columns twelve"
                                                style="text-align: right; margin-top:20px">
                                                <button class="btn primary">Save
                                                        Changes</button>
                                        </div>
                                        </div>

                                       
                                       

                                </div>


                        </div>
                </div>
        </div>

</section>


<script>
        document.addEventListener("DOMContentLoaded", function () {
        // Initialize Select2 for product tags
        $('#product-tags').select2({
                tags: true, 
                allowClear: true,
                ajax: {
                transport: function (params, success, failure) {
                        fetch(`/select-tags`, { 
                        method: "POST",
                        headers: {
                                "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                                search: params.data.term
                        })
                        })
                        .then(response => response.json())
                        .then(data => success(data))
                        .catch(error => failure(error));
                },
                processResults: function (data) {
                        return {
                        results: data.results
                        };
                }
                },
                createTag: function (params) {
                return {
                        id: params.term,
                        text: params.term,
                        newTag: true 
                };
                }
        });
        });

</script>


<script>
        //product js
        document.addEventListener("DOMContentLoaded", function () {
        // Initialize Select2 for product search
        $('#specific-products').select2({
                allowClear: true,
                ajax: {
                transport: function (params, success, failure) {
                        fetch(`/select-product`, {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ search: params.data.term })
                        })
                        .then(response => response.json())
                        .then(data => success(data))
                        .catch(error => failure(error));
                },
                processResults: function (data) {
                        return { results: data.results };
                }
                }
        });

        // Initialize Select2 for collection search
        $('#specific-collections').select2({
                allowClear: true,
                ajax: {
                transport: function (params, success, failure) {
                        fetch(`/select-collection`, {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ search: params.data.term })
                        })
                        .then(response => response.json())
                        .then(data => success(data))
                        .catch(error => failure(error));
                },
                processResults: function (data) {
                        return { results: data.results };
                }
                }
        });

        // Show/hide product selection container
        document.querySelectorAll('input[name="product_selection"]').forEach(input => {
                input.addEventListener("change", function () {
                document.getElementById("specific-selection-container").style.display = 
                        this.value === "specific" ? "block" : "none";
                });
        });
        });


</script>

<script>
        $(document).ready(function () {
            // Show/hide Specific User Tags dropdown based on radio selection
            $('input[name="user_selection"]').on("change", function () {
                if (this.value === "specific") {
                    $("#specific-user-tags-container").show();
                } else {
                    $("#specific-user-tags-container").hide();
                }
            });
        
            // Initialize Select2 for Specific User Tags
            $('#specific-user-tags').select2({
                allowClear: true,
                ajax: {
                    transport: function (params, success, failure) {
                        fetch(`/select-user-tags`, {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ search: params.data.term || '' })
                        })
                        .then(response => response.json())
                        .then(data => success({ results: data.tags.map(tag => ({ id: tag, text: tag })) }))
                        .catch(error => failure(error));
                    }
                }
            });
        });
</script>




<!--Tabs -->
<script>
        document.addEventListener("DOMContentLoaded", function () {
                const tabLinks = document.querySelectorAll(".tab-item a");
                const tabContents = document.querySelectorAll(".tab-content");
                const tabItems = document.querySelectorAll(".tab-item");

                tabLinks.forEach(link => {
                link.addEventListener("click", function (e) {
                        e.preventDefault();
                        const targetTab = this.getAttribute("data-tab");

                        // Remove active class from all tabs & hide all content
                        tabItems.forEach(t => t.classList.remove("active"));
                        tabContents.forEach(c => c.style.display = "none");

                        // Add active class to clicked tab & show related content
                        this.parentElement.classList.add("active");
                        document.getElementById(targetTab).style.display = "block";
                });
                });

        
    });
</script>
@endsection