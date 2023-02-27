/* global wcmp_vendor_shipping_script_data, ajaxurl */
(function ($, script_data, wp, ajaxurl) {
    $(function () {
        var app = app || {
            build: function () {
                this.init();
                this.bindEvents();
            },

            init: function () {
                this.shipping_zone_table = '.wcmp-shipping-zones';
                this.table_shipping_zone_settings = '.wcmp-shipping-zone-settings';
                this.table_shipping_zone_methods = '.wcmp-shipping-zone-methods';
                this.modify_shipping_methods = '.modify-shipping-methods';
                this.modal_add_shipping_method = '.wcmp-modal-add-shipping-method-modal';
                this.show_shipping_methods = this.table_shipping_zone_settings + ' .wcmp-shipping-zone-show-method';
                this.add_shipping_methods = this.modal_add_shipping_method + ' .wcmp-shipping-zone-add-method';
                this.edit_shipping_methods = this.table_shipping_zone_settings + ' .edit-shipping-method';
                this.delete_shipping_method = this.table_shipping_zone_settings + ' .delete-shipping-method';
                this.method_status = this.table_shipping_zone_methods + ' .method-status';
                this.limit_zone_location = this.table_shipping_zone_settings + ' #limit_zone_location';
            },

            bindEvents: function () {
                /* events */
                $(this.modify_shipping_methods).on('click', this.modify_shipping_methods_admin.bind(this));
                $( document ).on('zone_settings_loaded', this.zoneLoadedEvents.bind(this));
                $( document.body ).on( 'click', this.show_shipping_methods, this.showShippingMethods);
                $( document.body ).on( 'wc_backbone_modal_response', this.addShippingMethod );
                $( document.body ).on( 'wc_backbone_modal_response', this.updateShippingMethod );
                $( document.body ).on( 'click', this.edit_shipping_methods, this.editShippingMethod);
                $( document.body ).on( 'click', this.delete_shipping_method, this.deleteShippingMethod);
                $( document.body ).on( 'change', this.method_status, this.toggleShippingMethod);
                $( document.body ).on( 'change', this.limit_zone_location, this.limitZoneLocation);
                $( document.body ).on( 'change', '.wc-shipping-zone-method-selector select', this.onChangeShippingMethodSelector );
                this.limitZoneLocation();
            },

            modify_shipping_methods_admin: function (event, zoneID) {

                var appObj = this;
                $('.wcmp-shipping-zones').block({
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                });

                if (typeof event !== "undefined") {
                    event.preventDefault();
                    zoneID = $(event.currentTarget).data('zoneId');
                    vendor_id = $(event.currentTarget).data('vendor_id');

                }

                var ajaxRequest = $.ajax({
                    method: 'post',
                    url: wcmp_vendor_shipping_script_data.ajaxurl,
                    data: {
                        action: 'admin-get-vendor-shipping-methods-by-zone',
                        zoneID: zoneID,
                        vendor_id:vendor_id,
                        security: wcmp_vendor_shipping_script_data.nonce
                    },
                    success: function (response) {
                        $(appObj.table_shipping_zone_settings).html(response).show();
                        $(appObj.shipping_zone_table).hide();
                    },
                    complete: function () {
                         $('.wcmp-shipping-zones').unblock();
                         $(document).trigger('zone_settings_loaded');
                    }
                });
            },

            zoneLoadedEvents: function (event) {
                this.limitZoneLocation(event);
            },

            showShippingMethods: function (event) {
                event.preventDefault();
                var zoneId = $('#zone_id').val();
                $( this ).WCBackboneModal({
                        template : 'wcmp-modal-add-shipping-method',
                        variable : {
                                zone_id : zoneId
                        }
                });

                $( '.wc-shipping-zone-method-selector select' ).change();
            },
            
            onChangeShippingMethodSelector: function() {
                    var description = $( this ).find( 'option:selected' ).data( 'description' );
                    $( this ).parent().find( '.wc-shipping-zone-method-description' ).remove();
                    $( this ).after( '<div class="wc-shipping-zone-method-description">' + description + '</div>' );
                    $( this ).closest( 'article' ).height( $( this ).parent().height() );
            },

            addShippingMethod: function (event, target, posted_data) {
                if ( 'wcmp-modal-add-shipping-method' === target ) {
                    event.preventDefault();
                    var appObj = this;
                    var zoneId = posted_data.zone_id,
                        vendor_id = posted_data.vendor_id,
                        shippingMethod = posted_data.wcmp_shipping_method;
                    if (zoneId == '') {
                        // alert(wcmp_dashboard_messages.shiping_zone_not_found);
                    } else if (shippingMethod == '') {
                        // alert(wcmp_dashboard_messages.shiping_method_not_selected);
                    } else {
                        var data = {
                            action: 'wcmp-add-shipping-method',
                            zoneID: zoneId,
                            method: shippingMethod,
                            vendor_id:vendor_id,
                            security: wcmp_vendor_shipping_script_data.nonce
                        };

                        $(this.add_shipping_methods).block({
                            message: null,
                            overlayCSS: {
                                background: '#fff',
                                opacity: 0.6
                            }
                        });

                        // $('#wcmp_settings_save_button').click();

                        var ajaxRequest = $.ajax({
                            method: 'post',
                            url: ajaxurl,
                            data: data,
                            success: function (response) {
                                if (response.success) {
                                    
                                    if( !vendor_id ){
                                        location.reload();
                                    } else {
                                        var ajaxRequest = $.ajax({
                                            method: 'post',
                                            url: wcmp_vendor_shipping_script_data.ajaxurl,
                                            data: {
                                                action: 'admin-get-vendor-shipping-methods-by-zone',
                                                zoneID: zoneId,
                                                vendor_id:vendor_id,
                                                security: wcmp_vendor_shipping_script_data.nonce
                                            },
                                            success: function (response_modify_section) {
                                                $('.wcmp-shipping-zone-settings').html(response_modify_section).show();
                                                $(document).trigger('zone_settings_loaded');
                                            },
                                        });
                                    }

                                } else {

                                }
                            },
                        });
                    }
                }
                
            },

            editShippingMethod: function (event) {
                event.preventDefault();
                $( '.wcmp-shipping-zone-methods' ).block({
                        message: null,
                        overlayCSS: {
                                background: '#fff',
                                opacity: 0.6
                        }
                });
				
                var instanceId = $(event.currentTarget).data('instance_id'),
                        methodId = $(event.currentTarget).data('method_id'),
                        zoneId = $(event.currentTarget).data('zone_id'),
                        vendor_id = $(event.currentTarget).data('vendor_id'),
                        data = {
                            action: 'wcmp-configure-shipping-method',
                            zoneId: zoneId,
                            instanceId: instanceId,
                            methodId: methodId,
                            vendor_id:vendor_id,
                            security: wcmp_vendor_shipping_script_data.nonce
                        };
                $('#method_id_selected').val(methodId);
                $('#instance_id_selected').val(instanceId);
                
                var ajaxRequest = $.ajax({
                    method: 'post',
                    url: ajaxurl,
                    data: data,
                    success: function (response) {
                        if(response){
                            $( '.wcmp-shipping-zone-methods' ).unblock();
                            /* make popup */
                            $( this ).WCBackboneModal({
                                    template : 'wcmp-modal-update-shipping-method',
                                    variable : {
                                        methodId : methodId,
                                        instanceId : instanceId,
                                        config_settings : response
                                    }
                            });
                        }
                    },
                });
                
            },

            updateShippingMethod: function (event, target, posted_data) {
                if ( 'wcmp-modal-update-shipping-method' === target ) {
                    event.preventDefault();
                    var methodID = posted_data.method_id,
                        instanceId = posted_data.instance_id,
                        zoneId = posted_data.zone_id,
                        vendor_id = posted_data.vendor_id,
                        data = {
                            action: 'wcmp-update-shipping-method',
                            zoneID: zoneId,
                            posted_data: posted_data,
                            security: wcmp_vendor_shipping_script_data.nonce,
                            args: {
                                instance_id: instanceId,
                                zone_id: zoneId,
                                method_id: methodID,
                                vendor_id:vendor_id,
                                settings: {}
                            }
                        };
                    
                    var ajaxRequest = $.ajax({
                        method: 'post',
                        url: ajaxurl,
                        data: data,
                        success: function (response) {
                            if (response.success) {
                                if( !vendor_id ){
                                        location.reload();
                                } else {
                                    var ajaxRequest = $.ajax({
                                        method: 'post',
                                        url: wcmp_vendor_shipping_script_data.ajaxurl,
                                        data: {
                                            action: 'admin-get-vendor-shipping-methods-by-zone',
                                            zoneID: zoneId,
                                            vendor_id:vendor_id,
                                            security: wcmp_vendor_shipping_script_data.nonce
                                        },
                                        success: function (response_modify_section) {
                                            $('.wcmp-shipping-zone-settings').html(response_modify_section).show();
                                            $(document).trigger('zone_settings_loaded');
                                        },
                                    });
                                }

                            } else {
                                alert(response.data);
                            }
                        },
                    });
                    
                }
            },

            deleteShippingMethod: function (event) {
                event.preventDefault();

                var appObj = this;

                if (confirm(script_data.i18n.deleteShippingMethodConfirmation)) {
                    var currentTarget = $(event.target).is(this.delete_shipping_method) ? event.target : $(event.target).closest(this.delete_shipping_method),
                        vendor_id = $(event.currentTarget).data('vendor_id'),
                            instance_id = $(event.target).attr('data-instance_id'),
                            zoneId = $('#zone_id').val();
                    var data = data = {
                        action: 'wcmp-delete-shipping-method',
                        zoneID: zoneId,
                        instance_id: instance_id,
                        vendor_id:vendor_id,
                        security: wcmp_vendor_shipping_script_data.nonce
                    };

                    if (zoneId == '') {
                        // alert( wcmp_dashboard_messages.shiping_zone_not_found );
                    } else if (instance_id == '') {
                        // alert( wcmp_dashboard_messages.shiping_method_not_found );
                    } else {
                        // $('#wcmp_settings_save_button').click();

                        var ajaxRequest = $.ajax({
                            method: 'post',
                            url: ajaxurl,
                            data: data,
                            success: function (response) {
                                if (response.success) {
                                    if( !vendor_id ){
                                        location.reload();
                                    } else {
                                        var ajaxRequest = $.ajax({
                                            method: 'post',
                                            url: wcmp_vendor_shipping_script_data.ajaxurl,
                                            data: {
                                                action: 'admin-get-vendor-shipping-methods-by-zone',
                                                zoneID: zoneId,
                                                vendor_id:vendor_id,
                                                security: wcmp_vendor_shipping_script_data.nonce
                                            },
                                            success: function (response_modify_section) {
                                                $('.wcmp-shipping-zone-settings').html(response_modify_section).show();
                                                $(document).trigger('zone_settings_loaded');
                                            },
                                        });
                                    }

                                } else {
                                    alert(resp.data);
                                }
                            },
                        });
                    }
                }
            },
            
            limitZoneLocation: function (event) {
                if ($('#limit_zone_location').is(':checked')) {
                    $('.hide_if_zone_not_limited').show();
                    $('#select_zone_states').select2();
                } else {
                    $('.hide_if_zone_not_limited').hide();
                }
            },
            
            toggleShippingMethod: function (event) {
                event.preventDefault();

                var checked = $(event.target).is(':checked'),
                        value = $(event.target).val(),
                        vendor_id = $(event.currentTarget).data('vendor_id'),
                        zoneId = $('#zone_id').val();

                var data = {
                    action: 'wcmp-toggle-shipping-method',
                    zoneID: zoneId,
                    instance_id: value,
                    checked: checked,
                    vendor_id:vendor_id,
                    security: wcmp_vendor_shipping_script_data.nonce
                };

                if (zoneId == '') {
                    // alert( wcmp_dashboard_messages.shiping_zone_not_found );
                } else if (value == '') {
                    // alert( wcmp_dashboard_messages.shiping_method_not_found );
                } else {
                    $('.wcmp-container').block({
                        message: null,
                        overlayCSS: {
                            background: '#fff',
                            opacity: 0.6
                        }
                    });

                    var ajaxRequest = $.ajax({
                        method: 'post',
                        url: wcmp_vendor_shipping_script_data.ajaxurl,
                        data: data,
                        success: function (response) {
                            if (response.success) {
                                $('.wcmp-container').unblock();
                            } else {
                                $('.wcmp-container').unblock();
                                alert(response.data);
                            }
                        },
                    });
                }
            },
        };

        $(app.build.bind(app));
    });
})(jQuery, wcmp_vendor_shipping_script_data, wp, ajaxurl);

