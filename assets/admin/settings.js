(function ($) {

    let editors = [];
    let tabInitGeneral = 0;
    let tabInitGallery = 0;
    let tabInitCssGallery = 0;
    let tabInitTranslations = 0;
    let tabInitPageTemplate = 0;
    let tabInitResultTemplate = 0;
    let tabInitServiceTemplate = 0;
    let tabInitCardTemplate = 0;
    let tabInitCardCss = 0;
    let tabInitResultTemplateRoot = 0;
    let tabInitCssSearch = 0;
    let tabInitCssResults = 0;
    let tabInitCssService = 0;
    let ajax_loading = false;
    let defaultEditorHeight = 750;
    let $loader = $('#bentral-verify-key .loading-img');
    let $btnText = $('#bentral-verify-key span');
    let $input = $('#bentral_api_key');
    let $verificationMessage = $('#verification-message');
    let $verificationMessageParent = $verificationMessage.closest('td');

    function copyToClipboard(text) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function showLoading(AElement) {
        if (AElement === undefined) {
            AElement = "body";
        }
        $(AElement).block({
            message: '',
            css: {border: "none", padding: "2px", backgroundColor: "none"},
            baseZ: 2000,
            overlayCSS: {backgroundColor: "#000000", opacity: 0.2, cursor: "wait"}
        });
    }

    function hideLoading(AElement) {
        if (AElement === undefined) {
            AElement = "body";
        }
        $(AElement).unblock();
    }

    $("div.bentral-tab-menu>div.list-group>a").click(function (e) {
        e.preventDefault();
        let tabName = $(this).data('tab');


        $(".bentral-tab-menu .list-group-item").removeClass("active");
        $(this).addClass("active");

        $(".bentral-tab .bentral-tab-content").removeClass("active");
        $(".bentral-tab [data-tab='" + tabName + "']").addClass("active");

        initTab($(this).data('tab'));
    });

    $input.on('input', function () {
        $verificationMessage.text('').addClass('hidden')
    });

    $('#bentral_type').on('change', function (e) {
        if (this.value == 'bentral_full') {
            $('.delete_post_row').removeClass('hidden');

        } else {
            $('.delete_post_row').addClass('hidden');
        }
    });

    $('#bentral_result_property_title').on('change', function (e) {
        if (this.value == 'page') {
            $('.thumbnail-size').removeClass('hidden');

        } else {
            $('.thumbnail-size').addClass('hidden');
        }
    });

    $('#import_type').on('change', function (e) {
        if (this.value == 'custom') {
            $('.custom_type_row').removeClass('hidden');
        } else {
            $('.custom_type_row').addClass('hidden');
        }
    });

    $('#bentral_thumbnail_source').on('change', function (e) {
        if (this.value == 'wordpress') {
            $('.thumbnail-size').removeClass('hidden');
        } else {
            $('.thumbnail-size').addClass('hidden');
        }
    });

    $('#bentral_form_detect_lang').on('change', function (e) {
        if (this.value == '1') {
            $('.language-plugin').removeClass('hidden');
        } else {
            $('.language-plugin').addClass('hidden');
        }
    });


    $('#bentral_gallery_type').on('change', function (e) {
        if (this.value == 'thumbnail') {
            $('.gallery_type_thumbnail').removeClass('hidden');
            $('.gallery_type_slider').addClass('hidden');
        } else {
            $('.gallery_type_thumbnail').addClass('hidden');
            $('.gallery_type_slider').removeClass('hidden');
        }
    });

    $(document).on('click', '.bentral-show-hide-property-btn', function () {
        let tab = $(this).data('tab');

        if ($('.' + tab + ' .content').attr('style') == 'width: calc(100% - 400px)') {
            $('.' + tab + ' .content').attr('style', 'width: 100%');
            $('.' + tab + ' .info').attr('style', 'display:none;');
            if (tab == 'template-result') {
                $('.' + tab + ' .root_result_template').addClass('hidden');
            }
        } else {
            $('.' + tab + ' .content').attr('style', 'width: calc(100% - 400px)');
            $('.' + tab + ' .info').attr('style', 'padding-top: 10px; width: 400px');

            if (tab == 'template-result') {
                $('.' + tab + ' .root_result_template').attr('style', 'width: 100%').removeClass('hidden');
                tabInitResultTemplateRoot = initTabEditor(tabInitResultTemplateRoot, 'bentral_search_root_result_template', styleHtml);
            }
        }
    });

    $(document).on('change', '#bentral_translation_language_selected', function () {
        let tab = $(this).val();
        $('.section-language').addClass('hidden');
        $('.section-language[data-lang="' + tab + '"]').removeClass('hidden');
    });

    $(document).on('click', '#bentral-verify-key', function () {
        if (ajax_loading) {
            return false
        }
        $loader.toggleClass('hidden');
        $btnText.text(window.BentralSettings.verifying_text + '...');

        $.ajax({
            type: 'POST',
            url: window.BentralSettings.url,
            data: {
                nonce: window.BentralSettings.nonce,
                action: window.BentralSettings.action,
                bentral_key: $input.val().trim()
            },
            dataType: 'json',
            success: function (response) {
                $verificationMessageParent.removeClass('update-message notice-error updated-message')
                $verificationMessage.removeClass('hidden')
                if (response.valid) {
                    $verificationMessageParent.addClass('updated-message')
                    $verificationMessage.text(window.BentralSettings.key_valid)
                } else {
                    $verificationMessageParent.addClass('update-message notice-error')
                    $verificationMessage.text(window.BentralSettings.key_invalid)
                }
            },
            error: function (xhr) {
                alert(window.BentralSettings.failure_text);
            },
            complete: function () {
                ajax_loading = false;
                $loader.toggleClass('hidden');
                $btnText.text(window.BentralSettings.verify_key_text)
            }
        });
    });

    $(document).on('click', '.langSerialization', function () {
        $('.manual-lang-editor').removeClass('hidden');
        tabInitTranslations = initTabEditor(tabInitTranslations, 'bentral_lang_settings', styleJson);
        serializeLanguage();
    });

    $(document).on('change', '.lang-input', function (e) {
        serializeLanguage();
    });

    function serializeLanguage() {
        var langData = {};

        $("#bentral_translation_language_selected option").each(function () {
            let lng = $(this).attr('value');
            langData[lng] = {};

            $('.section-language[data-lang="' + lng + '"] input').each(function () {
                let langValue = $(this).val();
                let langName = $(this).attr('name').split('.');
                if (langName.length == 1) {
                    langData[lng][langName[0]] = langValue;
                } else {
                    if (!langData[lng].hasOwnProperty(langName[0])) {
                        langData[lng][langName[0]] = {};
                    }
                    langData[lng][langName[0]][langName[1]] = langValue;
                }
            });
        });
        if (tabInitTranslations == 0) {
            $('#bentral_lang_settings').val(JSON.stringify(langData, 2, "\t"));
        } else {
            editors['bentral_lang_settings'].codemirror.setValue(JSON.stringify(langData, 2, "\t"));
        }
    }

    $('#bentral_result_template_selected').on('change', function (e) {
        if (window.confirm("Your Result template and Style results will be lost?\nDo you want to continue?")) {
            loadTemplate($('#bentral_result_template_selected').val());
        }
    });

    function loadTemplate(templateName) {
        showLoading('.col-xs-10.bentral-tab');
        $.ajax({
            type: 'POST',
            url: window.BentralResultTemplate.url,
            data: {
                nonce: window.BentralResultTemplate.nonce,
                action: window.BentralResultTemplate.action,
                template: templateName
            },
            dataType: 'json',
            success: function (response) {
                $('#bentral_result_template').text(response.style);
                $('#bentral_result_style').text(response.style);
                if (editors['bentral_result_template'] != undefined) {
                    editors['bentral_result_template'].codemirror.setValue(response.template);
                }
                if (editors['bentral_result_style'] != undefined) {
                    editors['bentral_result_style'].codemirror.setValue(response.style);
                }

            },
            complete: function () {
                hideLoading('.col-xs-10.bentral-tab');
            }
        });
    }

    function loadPageTemplate() {
        $.ajax({
            type: 'POST',
            url: window.BentralPageTemplate.url,
            data: {
                nonce: window.BentralPageTemplate.nonce,
                action: window.BentralPageTemplate.action
            },
            dataType: 'json',
            success: function (response) {
                $('#bentral_page_template').val(response.data);
            },
            complete: function () {

            }
        });
    }

    function loadLanguage() {
        $.ajax({
            type: 'POST',
            url: window.BentralLoadLanguage.url,
            data: {
                nonce: window.BentralLoadLanguage.nonce,
                action: window.BentralLoadLanguage.action
            },
            dataType: 'json',
            success: function (response) {

            },
            complete: function () {

            }
        });
    }

    function saveLanguage() {
        $.ajax({
            type: 'POST',
            url: window.BentralSaveLanguage.url,
            data: {
                nonce: window.BentralSaveLanguage.nonce,
                action: window.BentralSaveLanguage.action
            },
            dataType: 'json',
            success: function (response) {

            },
            complete: function () {

            }
        });
    }

    function editor(elementId, elementHeight, modeType) {
        let elementEditor = wp.codeEditor.initialize($('#' + elementId), modeType);
        if (elementEditor != undefined) {
            elementEditor.codemirror.setSize(document.getElementById(elementId).innerWidth, elementHeight);
            editors[elementId] = elementEditor;
        }
    }

    function initGeneral() {
        if (tabInitGeneral == 1)
            return;

        editor('bentral-page-postmeta', 100, styleJson);
        editor('bentral_empty_search_result', 150, styleHtml);
        editor('bentral_error_search_result', 150, styleHtml);

        tabInitGeneral = 1;
    }

    function initTabEditor(statusVar, editElement, editorStyle, editorHeight) {
        if (statusVar == 1)
            return 1;

        if (editorHeight == undefined) {
            editorHeight = defaultEditorHeight;
        }

        editor(editElement, editorHeight, editorStyle);
        return 1;
    }

    function initTab(type) {

        if (type == undefined)
            return;

        $(document).on('click', '.xVar', function () {
            copyToClipboard($(this).text());
            $('.clipboard-info').addClass('hidden');
            $(this).parent().find('.clipboard-info').removeClass('hidden');
        });

        switch (type) {
            case 'general':
                initGeneral();
                break;
            case 'search-css':
                tabInitCssSearch = initTabEditor(tabInitCssSearch, 'bentral_search_style', styleCss);
                break;
            case 'results-template':
                tabInitResultTemplate = initTabEditor(tabInitResultTemplate, 'bentral_result_template', styleHtml);
                break;
            case 'results-css':
                tabInitCssResults = initTabEditor(tabInitCssResults, 'bentral_result_style', styleCss);
                break;
            case 'gallery':
                tabInitGallery = initTabEditor(tabInitGallery, 'bentral-image-template', styleHtml, 320);
                break;
            case 'gallery-css':
                tabInitCssGallery = initTabEditor(tabInitCssGallery, 'bentral_gallery_style', styleCss);
                break;
            case 'template-page':
                tabInitPageTemplate = initTabEditor(tabInitPageTemplate, 'bentral_page_template', styleHtml);
                break;
            case 'card-template':
                tabInitCardTemplate = initTabEditor(tabInitCardTemplate, 'bentral_card_template', styleHtml);
                break;
            case 'card-css':
                tabInitCardCss = initTabEditor(tabInitCardCss, 'bentral_card_style', styleCss);
                break;
            case 'service-template':
                tabInitServiceTemplate = initTabEditor(tabInitServiceTemplate, 'bentral_service_template', styleHtml);
                break;
            case 'service-css':
                tabInitCssService = initTabEditor(tabInitCssService, 'bentral_service_style_css', styleCss);
                break;
        }
        window.location.hash = type;
        $('.bentral-tab-menu').height($('#wpbody').innerHeight());
    }

    $(function () {
        let activeTab = (window.location.hash != '') ? window.location.hash : 'general';
        activeTab = activeTab.replace('#', '');

        $('a[data-tab="' + activeTab + '"]').click();
    });

})(jQuery);
