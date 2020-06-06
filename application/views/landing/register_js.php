<!DOCTYPE html>
<html lang="en">

<body>
    <script>
        FormValidation.formValidation(
            document.getElementById('register_form'), {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },

                    digits: {
                        validators: {
                            notEmpty: {
                                message: 'Digits is required'
                            },
                            digits: {
                                message: 'The velue is not a valid digits'
                            }
                        }
                    },

                    memo: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter memo text'
                            },
                            stringLength: {
                                min: 50,
                                max: 100,
                                message: 'Please enter a menu within text length range 50 and 100'
                            }
                        }
                    },

                    checkbox: {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Please kindly check this'
                            }
                        }
                    },

                    checkboxes: {
                        validators: {
                            choice: {
                                min: 2,
                                max: 5,
                                message: 'Please check at least 1 and maximum 2 options'
                            }
                        }
                    },

                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    </script>
</body>

</html>