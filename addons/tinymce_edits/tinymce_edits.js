(function($) {
    tinymce.PluginManager.add('hiiliteamp', function(editor, url) {

        var checkFormatMatch = function(alignment, ctrl, format, element) {

            // Check if the selection matches the format
            var formatMatch = editor.formatter.match(format+'_format');
            
            // Some magic to find the blockquote element from inside the selection
            var $selectedElement = $(editor.selection.getNode());

            if ($selectedElement.is(element)) {
                $blockquote = $selectedElement;
            } else {
                $blockquote = $selectedElement.closest(element);
            }

            var alignmentMatch = $blockquote.hasClass(format+'-' + alignment);
            var imageElementMatch = $blockquote.hasClass(format+'-image');

            // If all conditions are true, the button should be in its active state
            ctrl.active( (formatMatch && alignmentMatch) || (imageElementMatch) );
                
        };

        var toggleFormat = function(alignment, format, element) {

            if (!editor.formatter.match(format+'_format')) {

                // If the blockquote format is not already applied to the element, we apply it before doing anything else.
                editor.formatter.apply(format+'_format');

                // Some magic to find the blockquote element from inside the selection
                var $selectedElement = $(editor.selection.getNode());

				
                if ($selectedElement.is(element)) {
                    $blockquote = $selectedElement;
                } else {
                    $blockquote = $selectedElement.closest(element);
                }
				
				
                $blockquote.addClass(format+'-'+alignment);

                var $img = $blockquote.find('img');
                if ($img.length) {
                    $blockquote.addClass(format+'-image');
                } else {
                    $blockquote.addClass(format+'-text');
                }
                

            } else {

                // First we find the parent <blockquote> element
                var $selectedElement = $(editor.selection.getNode());
                var $blockquote = $selectedElement.closest('.'+format);

                
                // We also have to manually remove all classes that are not part of the formatter
                $blockquote.removeClass(format+'-text '+format+'-image '+format+'-left '+format+'-right '+format+'-center');
				//$blockquote.addClass(format+'-'+alignment)
                // And then simply remove the format to get rid of the blockquote
                editor.formatter.remove(format+'_format');
                
                toggleFormat(alignment, format, element);
             
            }

            editor.nodeChanged(); // refresh the button state

        };

        editor.on('init', function(e) {
            editor.formatter.register(
                'blockquote_format', {
                    block: 'blockquote',
                    classes: ['blockquote'],
                    //attributes: {'class': 'cc-blockquote-%value'},  // workaround for http://www.tinymce.com/develop/bugtracker_view.php?id=6472
                    wrapper: true
                }
            );
             editor.formatter.register(
                'align_format', {
                    block: 'div',
                    classes: ['align'],
                    //attributes: {'class': 'cc-blockquote-%value'},  // workaround for http://www.tinymce.com/develop/bugtracker_view.php?id=6472
                    wrapper: true
                }
            );
        });


/////////////////////
//
//	BLOCKQUOTES
//
////////////////////
        editor.addButton('BlockquoteLeft', {
            text: 'Blockquote Left',
            icon: false,
            onclick: function() {
                toggleFormat('left','blockquote','blockquote');
            },
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    checkFormatMatch('left', ctrl, 'blockquote','blockquote');
                });
            }
        });

        editor.addButton('BlockquoteCenter', {
            text: 'Blockquote Center',
            icon: false,
            onclick: function() {
                toggleFormat('center','blockquote','blockquote');
            },
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    checkFormatMatch('center', ctrl,'blockquote','blockquote');
                });
            }
        });

        editor.addButton('BlockquoteRight', {
            text: 'Blockquote Right',
            icon: false,
            onclick: function() {
                toggleFormat('right','blockquote','blockquote');
            },
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    checkFormatMatch('right', ctrl,'blockquote','blockquote');
                });
            }
        });
        
 //////////////////
 //
 //	ALIGNMENT
 //
 //////////////////      
        editor.addButton('AlignLeft', {
            //text: 'Align Left',
            icon: 'alignleft',
            onclick: function() {
                toggleFormat('left','align','div');
            },
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    checkFormatMatch('left', ctrl,'align','div');
                });
            }
        });

        editor.addButton('AlignCenter', {
            //text: 'Align Center',
            icon: 'aligncenter',
            onclick: function() {
                toggleFormat('center','align','div');
            },
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    checkFormatMatch('center', ctrl,'align','div');
                });
            }
        });

        editor.addButton('AlignRight', {
            //text: 'Align Right',
            icon: 'alignright',
            onclick: function() {
                toggleFormat('right','align','div');
            },
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    checkFormatMatch('right', ctrl,'align','div');
                });
            }
        });
        

    });
    
})(jQuery);