/*
 *  Document   : be_forms_validation.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Forms Validation Page
 */

// Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
class pageFormsValidation {
    /*
     * Init Validation functionality
     *
     */
    static initValidation() {
        // Load default options for jQuery Validation plugin
        One.helpers("validation");

        // Init Form Validation
        jQuery(".js-validation").validate({
            ignore: [],
            rules: {
                title: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                title: {
                    required: "رجاء أدخل عنوان الورقة البحثية",
                    minlength: "العنوان يجب أن لا يقل عن 3 أحرف"
                }
            }
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initValidation();
    }
}

// Initialize when page loads
jQuery(() => {
    pageFormsValidation.init();
});
