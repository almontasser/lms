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
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                id_number: {
                    required: true
                },
                position: {
                    required: true
                },
                type: {
                    required: true
                },
                password: {
                    minlength: 8
                },
                password_confirmation: {
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "رجاء أدخل اسم المستخدم",
                    minlength: "الإسم يجب أن لا يقل عن 3 أحرف"
                },
                email: "رجاء أدخل البريد الإلكتروني بشكل صحيح",
                id_number: "رجاء أدخل رقم القيد أو الرقم الوظيفي",
                position: "رجاء ادخل صفة المستخدم",
                type: "رجاء أدخل صلاحية المستخدم",
                password: {
                    required: "رجاء أدخل كلمة المرور",
                    minlength: "يجب أن لا تقل كلمة المرور عن 8 أحرف"
                },
                password_confirmation: {
                    required: "رجاء أدخل تأكيد كلمة المرور",
                    equalTo: "يجب أن تتطابق كلمة المرور مع التأكيد"
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
