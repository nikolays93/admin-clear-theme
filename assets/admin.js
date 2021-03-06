jQuery(document).ready(function($) {

    var menuSelector = '#adminmenu',
        menuItemSelector = menuSelector + ' > li',
        subMenuItemSelector = menuItemSelector + ' > ul > li';

        menuInputSelector = 'input#menu',
        subMenuInputSelector = 'input#sub_menu',

        // Добавим всем глазки
        // Insert icons
        addEyes = function( ItemsSelector ) {
            $(ItemsSelector).each(function() {
                $self = $(this);
                if( 'collapse-menu' == $self.attr('id') ) return;
                if( $self.hasClass( 'wp-menu-separator' ) ) return;
                if( $self.hasClass( 'hide-if-no-customize' ) ) return;

                $self.append( '<span class="after dashicons dashicons-hidden"></span>' );
            });
        },

        // Закрашиваем активные глазки после добавления
        // Fill icons
        checkActive = function() {
            var mainMenus = admin_settings.menu.split(',');
            var subMenus = admin_settings.sub_menu.split(',');

            mainMenus.forEach(function(item, i) {
                $('a[href="'+item+'"]:first').parent().children('.after').addClass('hide');
            });

            subMenus.forEach(function(item, i) {
                splitItem = item.split('>');
                $('a[href="'+splitItem[1]+'"]:last').parent().children('.after').addClass('hide');
            });
        },

        // Считываем нажатые глазки
        // insert result to fields
        compileResult = function() {
            var tmpResult = '';
            $(menuItemSelector).children('span.after').each(function() {
                if( $(this).hasClass('hide') )
                     tmpResult += $(this).parent().children('a').attr('href') + ',';
            });

            $(menuInputSelector).val(tmpResult);

            tmpResult = '';
            $(subMenuItemSelector).children('span.after').each(function() {
                if( !$(this).hasClass('hide') ) return;

                var parent = $(this).parent().parent().parent().children('a').attr('href');
                var obj = $(this).parent().children('a').attr('href');
                tmpResult += parent + '>' + obj +',';
            });

            $(subMenuInputSelector).val(tmpResult);
        };

    addEyes(menuItemSelector);
    addEyes(subMenuItemSelector);

    checkActive();
    compileResult();
    $(menuSelector + ' span.after').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('hide');

        compileResult();
    });

    // Toogle Cookie
    $('#admin_mode').on('click', function() {
        if( !$(this).hasClass('button-primary') ) {
            // insert
            var date = new Date(new Date().getTime() + 3600 * 24 * 7 * 1000);
            document.cookie = admin_settings.cookie_name + "=true; path=/; expires=" + date.toUTCString();
        }
        else {
            // delete
            document.cookie = admin_settings.cookie_name + "=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        }

        $(this).toggleClass('button-primary');
    });
});
