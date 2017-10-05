/*!
 * summernote bootstrap css plugin
 * http://www.shaunfreeman.name/
 *
 * Released under the MIT license
 */
(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals: jQuery
        factory(window.jQuery);
    }
}(function ($) {

    /*$.extend($.summernote.options, {
        callbacks: {
            onChange: function(e) {

            }
        }
    });*/

    // Extends plugins for adding bootstrap.
    //  - plugin is external module for customizing.
    $.extend($.summernote.plugins, {

        /**
         * @param {Object} context - context object has status of editor.
         */
        'bootstrap': function (context) {
            var self = this;

            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            var ui = $.summernote.ui;
            var dom = $.summernote.dom;
            var options = context.options;

            var del = ui.button({
                contents: '<del>D</del>',
                tooltip: 'Deleted text <del>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'del')
            });

            var ins = ui.button({
                contents: '<ins>I</ins>',
                tooltip: 'Inserted text <ins>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'ins')
            });

            var small = ui.button({
                contents: '<small>S</small>',
                tooltip: 'Small text <small>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'small')
            });

            var mark = ui.button({
                contents: '<mark>M</mark>',
                tooltip: 'Highlighted text <mark>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'mark')
            });

            var code = ui.button({
                contents: '<code>C</code>',
                tooltip: 'Inline code <code>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'code')
            });

            var kbd = ui.button({
                contents: '<kbd>K</kbd>',
                tooltip: 'User input <kbd>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'kbd')
            });

            var variable = ui.button({
                contents: '<var>V</var>',
                tooltip: 'Variable <var>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'var')
            });

            var samp = ui.button({
                contents: '<samp>S</samp>',
                tooltip: 'Sample <samp>',
                className: 'note-text-tags-btn',
                click: context.createInvokeHandler('bootstrap.formatInline', 'samp')
            });

            context.memo('button.bootstrap-helper', function () {
                return ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle',
                        contents: '<i class="fa fa-paint-brush"> B</i> ' + ui.icon(options.icons.caret, 'i'),
                        tooltip: "Bootstrap Text Styles",
                        data: {
                            toggle: 'dropdown'
                        },
                    }),
                    ui.dropdown({
                        className: 'dropdown-style scrollable-menu',
                        contents:
                        '<div class="list-group" style="margin: 0px; height: auto; max-height: 200px; min-width: 200px; max-width:300px; overflow-x: hidden;">' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="lead">Lead</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-uppercase">Text Uppercased</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-lowercase">Text Lowercased</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-capitalize">Text Capitalized</span></a>' +

                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-muted">Text Muted</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-primary">Text Primary</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-success">Text Success</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-info">Text Info</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-warning">Text Warning</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="text-danger">Text Danager</span></a>' +

                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="bg-primary">Background Primary</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="bg-success">Background Success</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="bg-info">Background Info</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="bg-warning">Background Warning</span></a>' +
                        '<a href="#" data-trigger="formatSpan" class="list-group-item"><span class="bg-danger">Background Danager</span></a>' +
                        '</div>',
                        callback: function($dropdown) {
                            $dropdown.find('a').each(function () {
                                $(this).click(function (e) {
                                    e.preventDefault();
                                    var call = $(this).attr('data-trigger');
                                    var type =  $(this).children('span').attr('class');
                                    context.invoke('bootstrap.' + call, type);
                                });
                            });
                        }
                    })
                ]).render()
            });

            context.memo('button.bootstrap-inline', function () {
                return ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle bootstrap-inline',
                        contents: '<b><i class="fa fa-html5"> B</i></b> ' + ui.icon(options.icons.caret, 'i'),
                        tooltip: 'Bootstrap Inline Styles',
                        data: {
                            toggle: 'dropdown'
                        }
                    }),
                    ui.dropdown([
                        ui.buttonGroup({
                            className: 'note-bootstrap-inline',
                            children: [del, ins, small, mark]
                        }),
                    ]),
                ]).render();
            });

            context.memo('button.bootstrap-code', function () {
                return ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle bootstrap-code',
                        contents: '<b><i class="fa fa-code"> B</i></b> ' + ui.icon(options.icons.caret, 'i'),
                        tooltip: 'Bootstrap Code Styles',
                        data: {
                            toggle: 'dropdown'
                        }
                    }),
                    ui.dropdown([
                        ui.buttonGroup({
                            className: 'note-bootstrap-code',
                            children: [code, kbd, variable, samp]
                        }),
                    ]),
                ]).render();
            });

            context.memo('button.bootstrap-class-styles', function () {
                return ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle bootstrap-classes',
                        contents: '<b><i class="fa fa-css3"> B</i></b> ' + ui.icon(options.icons.caret, 'i'),
                        tooltip: 'Bootstrap Class Styles',
                        data: {
                            toggle: 'dropdown'
                        }
                    }),
                    ui.dropdown({
                        className: 'dropdown-style scrollable-menu',
                        contents:
                        '<div class="list-group" style="margin: 0px; height: auto; max-height: 200px; min-width: 200px; max-width:300px; overflow-x: hidden;">' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="pre-scrollable">Pre scrollable</span></a>' +
                        '<a href="#" data-trigger="styleBlockquote" class="list-group-item"><span class="blockquote-reverse">Blockquote reverse</span></a>' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="text-left">Left aligned text</span></a>' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="text-center">Center aligned text</span></a>' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="text-right">Right aligned text</span></a>' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="text-justify">Justified text</span></a>' +
                        '<a href="#" data-trigger="styleBlock" class="list-group-item"><span class="text-nowrap">No wrap text</span></a>' +
                        '</div>',
                        callback: function($dropdown) {
                            $dropdown.find('a').each(function () {
                                $(this).click(function (e) {
                                    e.preventDefault();
                                    var call = $(this).attr('data-trigger');
                                    var type =  $(this).children('span').attr('class');
                                    context.invoke('bootstrap.' + call, type);
                                });
                            });
                        }
                    })
                ]).render();
            });

            this.styleBlockquote = function(classType) {
                var obj = this.getSelectionObject();

                if (obj.node.is('blockquote')) {
                    if (obj.node.hasClass(classType)) {
                        obj.node.removeClass(classType);
                    } else {
                        obj.node.addClass(classType);
                    }
                }

                this.detach(obj);
            };

            this.styleBlock = function (classType) {
                var obj = this.getSelectionObject();

                if (obj.parentNode.hasClass(classType)) {
                    obj.parentNode.removeClass(classType);
                } else {
                    obj.parentNode.addClass(classType);
                }

                this.detach(obj);
            };

            this.formatInline = function(tag) {
                var obj = this.getSelectionObject();

                if (obj.parentNode.is(tag)) {
                    obj.node.unwrap();
                } else {
                    if (obj.range.startOffset !== obj.range.endOffset) {
                        node = $('<' + tag + '>');
                        obj.range.surroundContents(node[0]);
                    }
                }

                this.detach(obj);
            };

            this.formatSpan = function(classType) {
                var obj = this.getSelectionObject();

                if (obj.parentNode.is('span')) {
                    if (obj.parentNode.is('span.' + classType)) {
                        obj.node.unwrap();
                    } else {
                        obj.parentNode.attr('class', classType);
                    }
                } else {
                    if (obj.range.startOffset !== obj.range.endOffset) {
                        var node = $('<span>').attr('class', classType);
                        obj.range.surroundContents(node[0]);
                    }
                }

                this.detach(obj);
            };

            this.initialize = function () {
                $('.note-bootstrap-inline').parent().addClass('bootstrap-tags-inline');
                $('.note-bootstrap-code').parent().addClass('bootstrap-tags-code');
            };

            this.getSelectionObject = function() {
                var selection = window.getSelection();
                var range = selection.getRangeAt(0);

                return {
                    selection : selection,
                    range : range,
                    parentNode : $(selection.focusNode.parentNode),
                    node : $(range.commonAncestorContainer)
                }
            };

            this.detach = function(obj) {
                obj.range.collapse(false);
                obj.range.detach();

                context.invoke('editor.afterCommand');
            };

            // This methods will be called when editor is destroyed by $('..').summernote('destroy');
            // You should remove elements on `initialize`.
            this.destroy = function () {
                this.$panel.remove();
                this.$panel = null;
            };
        }
    });
}));