@extends('shopify-app::layouts.default')

@section('content')
<section>
    <div class="card">
        <div class="row"
            style="display: flex; justify-content: space-between; align-items: center; width: 98%; margin: 0 auto;">
            <div class="columns">
                <h2 class="card-header"><b>Addify Storewide Sale </b></h2>
            </div>
            <div class="columns" style="display: flex; justify-content:end; gap: 10px;">
                <button class="button primary">Change Plan</button>
                <button class="button primary">Guide</button>
            </div>
        </div>



        <div class="columns has-sections">
            <!-- Tabs Navigation -->
            <ul class="tabs">
                <li class="tab-item active"><a href="#" data-tab="general">General Settings</a></li>
                <li class="tab-item"><a href="#" data-tab="restriction">Restrictions</a></li>
                <li class="tab-item"><a href="#" data-tab="notification">Notification Settings</a></li>
            </ul>


            <div class="card-section">
                <div id="general" class="tab-content active">
                    <div class="card">
                        <div class="alert success" id="success-container" style="display: none;">
                            <dl>
                                <dt>Success Alert</dt>
                                <dd id="success-message" style="color: green; margin-bottom: 10px;"></dd>
                            </dl>
                        </div>

                        <div class="alert error" id="error-container" style="display: none;">
                            <dl>
                                <dt>Error Alert</dt>
                                <dd id="error-message" style="color: red; margin-bottom: 10px;">
                                    Something went wrong. Try again.</dd>
                            </dl>
                        </div>


                        <form id="sale-general-form">

                            <div class="card-body" style="margin-top: 20px;">

                                <div class="row">
                                    <label class="columns five"><b>App Status</b> <br>
                                    <em>Enable/Disable </em>
                                    </label>
                                    <div class="columns seven">
                                        <select name="storewide_sale" class="input select2" style="">
                                            <option value="1" {{ isset($general_settings) && $general_settings->isEnable
                                                == 1 ? 'selected' : '' }}>
                                                ✅
                                                Enable</option>
                                            <option value="0" {{ isset($general_settings) && $general_settings->isEnable
                                                == 0 ? 'selected' : '' }}>
                                                ❌
                                                Disable</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="columns twelve" style="text-align: right; margin-top:20px">
                                    <button class="btn primary">Save
                                    </button>
                                </div>





                            </div>
                        </form>
                    </div>
                </div>



                <!-- Role Restrictions Tab -->
                <div id="restriction" class="tab-content" style="display: none;">
                    <form id="role-restriction-form">
                        <!-- Sale Details Card -->
                        <div class="card">

                            <div class="alert success" id="role-success-container" style="display: none;">
                                <dl>
                                    <dt>Success Alert</dt>
                                    <dd id="role-success-message"></dd>
                                </dl>
                            </div>

                            <div class="alert error" id="role-error-container" style="display: none;">
                                <dl>
                                    <dt>Error Alert</dt>
                                    <dd id="role-error-message">Something went wrong. Try again.</dd>
                                </dl>
                            </div>


                            <div class="card-header text-center" style="margin: 10px 0">
                                <b>Sale Details</b>
                            </div>

                            <div class="card-body">
                                <!-- Sale Type -->
                                <div class="row">
                                    <label class="columns four">Select Sale Type</label>
                                    <div class="columns eight">
                                        <label><input type="radio" name="sale_type" value="1" {{
                                                isset($role_restriction_settings) &&
                                                $role_restriction_settings->sale_type == 1 ? 'checked' : '' }}>
                                            Percentage
                                            (%)</label>
                                        <label class="ml-3"><input type="radio" name="sale_type" value="0" {{
                                                isset($role_restriction_settings) &&
                                                $role_restriction_settings->sale_type == 0 ? 'checked' : '' }}>
                                            Fixed</label>
                                    </div>
                                </div>

                                <!-- Sale Amount -->
                                <div class="row">
                                    <label class="columns four">Sale Amount</label>
                                    <div class="columns eight">
                                        <input type="text" placeholder="Enter sale amount" class="input"
                                            name="sale_amount" value="{{ $role_restriction_settings->sale_amount }}"
                                            style="width: 100%; padding: 10px;" required>
                                    </div>
                                </div>

                                <!-- Sale Start -->
                                <div class="row" style="display: flex; align-items: center; margin-bottom: 15px;">
                                    <label class="columns four">Sale Start From</label>
                                    <div class="columns four" style="margin-right: 6px;">
                                        <input type="date" class="input" name="start_date"
                                            value="{{ isset($role_restriction_settings) ? $role_restriction_settings->start_date : '' }}"
                                            style="width: 90%; padding: 10px;" required min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="columns four">
                                        <input type="time" class="input" name="start_time"
                                            value="{{ isset($role_restriction_settings) ? $role_restriction_settings->start_time : '' }}"
                                            style="width: 32%; padding: 10px;" required>
                                    </div>
                                </div>

                                <!-- Sale End -->
                                <div class="row" style="display: flex; align-items: center; margin-bottom: 15px;">
                                    <label class="columns four">Sale End On</label>
                                    <div class="columns four" style="margin-right: 6px;">
                                        <input type="date" class="input" name="end_date"
                                            value="{{ isset($role_restriction_settings) ? $role_restriction_settings->end_date : '' }}"
                                            style="width: 90%; padding: 10px;" required min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="columns four">
                                        <input type="time" class="input" name="end_time"
                                            value="{{ isset($role_restriction_settings) ? $role_restriction_settings->end_time : '' }}"
                                            style="width: 32%; padding: 10px;" required>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- User Selection Card -->
                        <div class="card">
                            <div class="card-header" style="margin: 10px 0">
                                <b>Customers Restrictions</b>
                            </div>
                            <div class="card-body">
                                <!-- Guest -->
                                <div class="row">
                                    <label class="columns four">Guest</label>
                                    <div class="columns eight">
                                        <input type="checkbox" name="isGuest" value="1" {{
                                            isset($role_restriction_settings) && $role_restriction_settings->isGuest ==
                                        1 ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <!-- Users Selection -->
                                <div class="row">
                                    <label class="columns four">Select Customers</label>
                                    <div class="columns eight">
                                        <label><input type="radio" name="user_selection" value="1" {{
                                                isset($role_restriction_settings) &&
                                                $role_restriction_settings->user_selection == 1 ? 'checked' : '' }}>
                                            All
                                            Customers</label>
                                        <label class="ml-3"><input type="radio" name="user_selection" value="0" {{
                                                isset($role_restriction_settings) &&
                                                $role_restriction_settings->user_selection == 0 ? 'checked' : '' }}>
                                             Specific Customers tags
                                            </label>
                                    </div>
                                </div>

                                <!-- Specific User Tags Dropdown -->
                                <div class="row" id="specific-user-tags-container" style="display: none;">
                                    <label class="columns four">Select  Customers
                                        Tags</label>
                                    <div class="columns eight">
                                        <select id="specific-user-tags" name="specific_user_tags[]"
                                            class="input select2" multiple="multiple" style="width: 100%;"
                                            placeholder="Search user tags...">
                                            @if (isset($role_restriction_settings->specific_user_tags))
                                            @foreach ($role_restriction_settings->specific_user_tags as $tag)
                                            <option value="{{ $tag }}" selected>{{ $tag }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>



                            </div>
                        </div>

                        <!-- Product Selection Card -->
                        <div class="card">
                            <div class="card-header" style="margin: 10px 0">
                                <b>Select Product</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="columns four">
                                        Products Selection</label>
                                    <div class="columns eight">
                                        <label><input type="radio" name="product_selection" value="1" {{
                                                isset($role_restriction_settings) &&
                                                $role_restriction_settings->product_selection == 1 ? 'checked' : '' }}>
                                            All
                                            Products</label>
                                        <label class="ml-3"><input type="radio" name="product_selection" value="0" {{
                                                isset($role_restriction_settings) &&
                                                $role_restriction_settings->product_selection == 0 ? 'checked' : '' }}>
                                            Specific
                                            Products</label>
                                    </div>
                                </div>

                                <div id="specific-selection-container">
                                    <!-- Specific Products -->
                                    <div class="row">
                                        <label class="columns four">Select Specific
                                            Products</label>
                                        <div class="columns eight">
                                            <select id="specific-products" class="input select2"
                                                name="specific_products[]" multiple="multiple" style="width: 100%;"
                                                placeholder="Search products...">
                                                @if (isset($productNames))
                                                @foreach ($productNames as $id => $name)
                                                <option value="{{ $id }}" selected>
                                                    {{ $name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Collections -->
                                    <div class="row" id="collection-selection-container">
                                        <label class="columns four">Select
                                            Collections</label>
                                        <div class="columns eight">
                                            <select id="specific-collections" class="input select2"
                                                name="include_collections[]" multiple="multiple" style="width: 100%;"
                                                placeholder="Search collections...">
                                                @if (isset($collectionNames))
                                                @foreach ($collectionNames as $id => $name)
                                                <option value="{{ $id }}" selected>
                                                    {{ $name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
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
                                    <label class="columns four">Select Product Tags</label>
                                    <div class="columns eight">
                                        <select id="product-tags" class="input select2" name="product_tags[]"
                                            multiple="multiple" style="width: 100%;">
                                            @if (isset($role_restriction_settings->product_tags))
                                            @foreach ($role_restriction_settings->product_tags as $tag)
                                            <option value="{{ $tag }}" selected>{{ $tag }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="columns twelve" style="text-align: right; margin-top:20px">
                                <button type="submit" class="btn primary">Save
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- Notification Settings Tab -->
                <div id="notification" class="tab-content" style="display: none;">

                    <form id="notification-form">
                        <!-- Top Bar Notification Settings Card -->
                        <div class="card">
                            <div class="alert success" id="notification-success-container" style="display: none;">
                                <dl>
                                    <dt>Success Alert</dt>
                                    <dd id="notification-success-message"></dd>
                                </dl>
                            </div>

                            <div class="alert error" id="notification-error-container" style="display: none;">
                                <dl>
                                    <dt>Error Alert</dt>
                                    <dd id="notification-error-message">Something went wrong. Try again.</dd>
                                </dl>
                            </div>



                            <div class="card-header text-center">
                                <b>Top Bar Notification Settings</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="columns five">Enable Storewide Topbar Sale Notification</label>
                                    <div class="columns seven">
                                        <select name="is_top_bar_enable" class="input select2">
                                            <option value="1" {{ isset($notification_settings) &&
                                                $notification_settings->is_top_bar_enable == 1 ? 'selected' : '' }}>
                                                ✅ Enable</option>
                                            <option value="0" {{ isset($notification_settings) &&
                                                $notification_settings->is_top_bar_enable == 0 ? 'selected' : '' }}>
                                                ❌ Disable</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="columns five">Notification Content</label>
                                    <div class="columns seven">
                                        <textarea name="notification_content" id="notification_content" class="test-editor">
                                            {{ $notification_settings->notification_content }}
                                        </textarea>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <label class="columns five">Notification Background Color</label>
                                    <div class="columns seven">
                                        <input type="color" name="notification_bg_color"
                                            value="{{ $notification_settings->notification_bg_color }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="columns five">Notification Font Color</label>
                                    <div class="columns seven">
                                        <input type="color" name="notification_color"
                                            value="{{ $notification_settings->notification_color }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Popup Notification Settings Card -->
                        <div class="card">
                            <div class="card-header text-center">
                                <b>Popup Notification Settings</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="columns five">Enable Storewide Popup Notification</label>
                                    <div class="columns seven">
                                        <select name="is_popup_enable" class="input select2">
                                            <option value="1" {{ isset($notification_settings) &&
                                                $notification_settings->is_popup_enable == 1 ? 'selected' : '' }}>
                                                ✅ Enable</option>
                                            <option value="0" {{ isset($notification_settings) &&
                                                $notification_settings->is_popup_enable == 0 ? 'selected' : '' }}>
                                                ❌ Disable</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="columns five">Popup Content</label>
                                    <div class="columns seven">
                                        <textarea name="popup_content" id="popup_content" class="test-editor">
                                            {{ $notification_settings->popup_content }}
                                        </textarea>
                                    </div>
                                </div>
                                

                                

                                <div class="row">
                                    <label class="columns five">Popup Background Color</label>
                                    <div class="columns seven">
                                        <input type="color" name="popup_bg_color"
                                            value="{{ $notification_settings->popup_bg_color }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="columns five">Popup Font Color</label>
                                    <div class="columns seven">
                                        <input type="color" name="popup_color"
                                            value="{{ $notification_settings->popup_color }}">
                                    </div>
                                </div>
                            </div>

                            <div class="columns twelve" style="text-align: right; margin-top:20px">
                                <button type="submit" class="btn primary">Save</button>
                            </div>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>

</section>

{{-- general setting form submission js --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("sale-general-form").addEventListener("submit", function(e) {
                e.preventDefault();

                let isEnable = document.querySelector("select[name='storewide_sale']").value;

                fetch(`/is-sale-enable`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            isEnable: isEnable
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message from backend
                            let successContainer = document.getElementById("success-container");
                            let messageDiv = document.getElementById("success-message");

                            messageDiv.innerHTML = data.message;
                            successContainer.style.display = "block";

                            setTimeout(() => {
                                successContainer.style.display = "none";
                            }, 3000);
                        } else {
                            showErrorMessage();
                        }
                    })
                    .catch(error => {
                        showErrorMessage();
                        console.error("Error:", error);
                    });

                function showErrorMessage() {
                    let errorContainer = document.getElementById("error-container");
                    let errorMessageDiv = document.getElementById("error-message");

                    errorMessageDiv.innerHTML = "Something went wrong. Try again.";
                    errorContainer.style.display = "block";

                    setTimeout(() => {
                        errorContainer.style.display = "none";
                    }, 3000);
                }
            });
        });
</script>


{{-- role restriction form submission js --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("role-restriction-form").addEventListener("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                fetch(`role-restriction-form`, {
                        method: "POST",
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccessMessage(data.message);
                            window.scrollTo({
                                top: 0,
                                behavior: "smooth"
                            });
                        } else {
                            showErrorMessage();
                        }
                    })
                    .catch(error => {
                        showErrorMessage();
                        console.error("Error:", error);
                    });

                function showSuccessMessage(message) {
                    let successContainer = document.getElementById("role-success-container");
                    let successMessage = document.getElementById("role-success-message");

                    successMessage.innerHTML = message;
                    successContainer.style.display = "block";

                    setTimeout(() => {
                        successContainer.style.display = "none";
                    }, 3000);
                }

                function showErrorMessage() {
                    let errorContainer = document.getElementById("role-error-container");
                    let errorMessage = document.getElementById("role-error-message");

                    errorMessage.innerHTML = "Something went wrong. Try again.";
                    errorContainer.style.display = "block";

                    setTimeout(() => {
                        errorContainer.style.display = "none";
                    }, 3000);
                }
            });
        });
</script>

{{-- notification form --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("notification-form").addEventListener("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                formData.set('notification_content', $('#notification_content').trumbowyg('html'));
                formData.set('popup_content', $('#popup_content').trumbowyg('html'));

                fetch(`notification-setting`, {
                        method: "POST",
                        body: formData,
                })

                .then(response => response.json())
                .then(data => {
                        if (data.success) {
                            showSuccessMessage(data.message);
                            window.scrollTo({
                                top: 0,
                                behavior: "smooth"
                            });
                        } else {
                            showErrorMessage();
                        }
                    })
                    .catch(error => {
                        showErrorMessage();
                        console.error("Error:", error);
                    });
            });

            function showSuccessMessage(message) {
                let successContainer = document.getElementById("notification-success-container");
                let successMessage = document.getElementById("notification-success-message");

                successMessage.innerHTML = message;
                successContainer.style.display = "block";

                setTimeout(() => {
                    successContainer.style.display = "none";
                }, 3000);
            }

            function showErrorMessage() {
                let errorContainer = document.getElementById("notification-error-container");
                let errorMessage = document.getElementById("notification-error-message");

                errorMessage.innerHTML = "Something went wrong. Try again.";
                errorContainer.style.display = "block";

                setTimeout(() => {
                    errorContainer.style.display = "none";
                }, 3000);
            }
        });
</script>


{{-- products tags js --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
            // Initialize Select2 for product tags
            $('#product-tags').select2({
                tags: true,
                allowClear: true,
                ajax: {
                    transport: function(params, success, failure) {
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
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    }
                },
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    };
                }
            });
        });
</script>

{{-- all and specific product js --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
            // Initialize Select2 for product search
            $('#specific-products').select2({
                allowClear: false,
                ajax: {
                    transport: function(params, success, failure) {
                        fetch(`/select-product`, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    search: params.data.term
                                })
                            })
                            .then(response => response.json())
                            .then(data => success(data))
                            .catch(error => failure(error));
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    }
                }
            });

            // Initialize Select2 for collection search
            $('#specific-collections').select2({
                allowClear: false,
                ajax: {
                    transport: function(params, success, failure) {
                        fetch(`/select-collection`, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    search: params.data.term
                                })
                            })
                            .then(response => response.json())
                            .then(data => success(data))
                            .catch(error => failure(error));
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    }
                }
            });

            // Show/hide product selection container based on radio button selection
            $('input[name="product_selection"]').on("change", function() {
                $("#specific-selection-container").toggle($(this).val() === "0");
            });

            if ($('input[name="product_selection"]:checked').val() === "0") {
                $("#specific-selection-container").show();
            } else {
                $("#specific-selection-container").hide();
            }




        });
</script>


{{-- all and speific user js --}}
<script>
    $(document).ready(function() {
            // Show/hide Specific User Tags dropdown based on radio selection
            $('input[name="user_selection"]').on("change", function() {
                $("#specific-user-tags-container").toggle(this.value == "0");
            });

            if ($('input[name="user_selection"]:checked').val() == "0") {
                $("#specific-user-tags-container").show();
            }

            // Initialize Select2 for Specific User Tags
            $('#specific-user-tags').select2({
                allowClear: false,
                ajax: {
                    transport: function(params, success, failure) {
                        fetch(`/select-user-tags`, {
                                method: "POST",
                                delay: 250,
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    search: params.data.term || ''
                                })
                            })
                            .then(response => response.json())
                            .then(data => success({
                                results: data.tags.map(tag => ({
                                    id: tag,
                                    text: tag
                                }))
                            }))
                            .catch(error => failure(error));
                    }
                }
            });
        });
</script>



<!--Tabs -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const tabLinks = document.querySelectorAll(".tab-item a");
            const tabContents = document.querySelectorAll(".tab-content");
            const tabItems = document.querySelectorAll(".tab-item");

            tabLinks.forEach(link => {
                link.addEventListener("click", function(e) {
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