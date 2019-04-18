$('.login-form').formValidation({
  framework: 'bootstrap',
  excluded: ':disabled',
  message: 'This value is not valid',
  icon: {
    valid: 'fa fa-checks',
    invalid: 'fa fa-timess',
    validating: 'fa fa-refreshs'
  },
  fields: {
    email: {
      validators: {
        notEmpty: {
          message: 'Enter Email Address !'
        },
        emailAddress: {
          message: 'Enter Valid Email Address !'
        }
      }
    },
    password: {
      validators: {
        notEmpty: {
          message: 'Enter Password'
        },
      }
    },
  }
});
$('#user_add').formValidation({
  framework: 'bootstrap',
  excluded: ':disabled',
  message: 'This value is not valid',
  icon: {
    valid: 'fa fa-checks',
    invalid: 'fa fa-timess',
    validating: 'fa fa-refreshs'
  },
  fields: {
    email: {
      validators: {
        notEmpty: {
          message: 'Enter Email Address !'
        },
        emailAddress: {
          message: 'Enter Valid Email Address !'
        }
      }
    },
    name: {
      validators: {
        notEmpty: {
          message: 'Enter Name'
        },
      }
    },
    password: {
      validators: {
        notEmpty: {
          message: 'Enter Password'
        },
      }
    },
    passwordAgain: {
        validators: {
			notEmpty: {
                message: 'Confirm Your Password !'
            },
			identical: {
				field: 'password',
				message: 'Password Does not Match !'
			}
		}
    }
  }
});
$('#user_edit').formValidation({
  framework: 'bootstrap',
  excluded: ':disabled',
  message: 'This value is not valid',
  icon: {
    valid: 'fa fa-checks',
    invalid: 'fa fa-timess',
    validating: 'fa fa-refreshs'
  },
  fields: {
    email: {
      validators: {
        notEmpty: {
          message: 'Enter Email Address !'
        },
        emailAddress: {
          message: 'Enter Valid Email Address !'
        }
      }
    },
    name: {
      validators: {
        notEmpty: {
          message: 'Enter Name'
        },
      }
    },

    passwordAgain: {
        validators: {
			identical: {
				field: 'password',
				message: 'Password Does not Match !'
			}
		}
    }
  }
});
$('.form-category').formValidation({
    framework: 'bootstrap',
    excluded: ':disabled',
    message: 'This value is not valid',
    icon: {
        valid: 'fa fa-checks',
        invalid: 'fa fa-timess',
        validating: 'fa fa-refreshs'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'Enter category Name !'
                },
            }
        },
    }
});

$('#form_admin_usrs').formValidation({
  framework: 'bootstrap',
  excluded: ':disabled',
  message: 'This value is not valid',
  icon: {
    valid: 'fa fa-checks',
    invalid: 'fa fa-timess',
    validating: 'fa fa-refreshs'
  },
  fields: {
        email: {
          validators: {

            emailAddress: {
              message: 'Enter Valid Email Address !'
            }
          }
        },
        fullName: {
          validators: {
            notEmpty: {
              message: 'Enter Full Name'
            },
          }
        },
        establish_year: {
          validators: {
            notEmpty: {
              message: 'Select Establish Year'
            },
          }
        },
        role: {
          validators: {
            notEmpty: {
              message: 'Select Role'
            },
          }
        },
        bank_account: {
          validators: {
            notEmpty: {
              message: 'Enter Bank Account'
            },
          }
        },
        gst: {
          validators: {
            notEmpty: {
              message: 'Enter GST'
            },
          }
        },
        business_type: {
          validators: {
            notEmpty: {
              message: 'Select Business Type'
            },
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Enter Password'
            },
          }
        },
        passwordAgain: {
            validators: {
    			notEmpty: {
                    message: 'Confirm Your Password !'
                },
    			identical: {
    				field: 'password',
    				message: 'Password Does not Match !'
    			}
    		}
        },
        file: {
            validators: {
				file: {
                    extension: 'jpeg,jpg,png',
                    type: 'image/jpeg,image/png',
                    maxSize: 102400,   // 100 kb
                    message: 'Select jpg,jpeg,png less than 100kb File !'
                }
            }
        },
    }
});
$('#form_admin_usrs_edit').formValidation({
  framework: 'bootstrap',
  excluded: ':disabled',
  message: 'This value is not valid',
  icon: {
    valid: 'fa fa-checks',
    invalid: 'fa fa-timess',
    validating: 'fa fa-refreshs'
  },
  fields: {
        email: {
          validators: {

            emailAddress: {
              message: 'Enter Valid Email Address !'
            }
          }
        },
        fullName: {
          validators: {
            notEmpty: {
              message: 'Enter Full Name'
            },
          }
        },
        establish_year: {
          validators: {
            notEmpty: {
              message: 'Select Establish Year'
            },
          }
        },
        role: {
          validators: {
            notEmpty: {
              message: 'Select Role'
            },
          }
        },
        bank_account: {
          validators: {
            notEmpty: {
              message: 'Enter Bank Account'
            },
          }
        },
        gst: {
          validators: {
            notEmpty: {
              message: 'Enter GST'
            },
          }
        },
        business_type: {
          validators: {
            notEmpty: {
              message: 'Select Business Type'
            },
          }
        },

        passwordAgain: {
            validators: {

    			identical: {
    				field: 'password',
    				message: 'Password Does not Match !'
    			}
    		}
        },

    }
});

$('#form_admin_products_add').formValidation({
  framework: 'bootstrap',
  excluded: ':disabled',
  message: 'This value is not valid',
  icon: {
    valid: 'fa fa-checks',
    invalid: 'fa fa-timess',
    validating: 'fa fa-refreshs'
  },
  fields: {
        color: {
          validators: {
            notEmpty: {
              message: 'Select color !'
            }
          }
        },
        weight: {
          validators: {
            notEmpty: {
              message: 'Select weight !'
            }
          }
        },
        category: {
          validators: {
            notEmpty: {
              message: 'Select category !'
            }
          }
        },
        name: {
          validators: {
            notEmpty: {
              message: 'Enter Prodact Name'
            },
          }
        },
        price: {
          validators: {
            notEmpty: {
              message: 'Enter Sale Price'
            },
            numeric: {
                message: 'The price must be a number'
            }
          }
        },
        stock: {
          validators: {
            notEmpty: {
              message: 'Enter Stock'
            },
            integer: {
                message: 'The stock must be a number'
            }
          }
        },

    }
});
