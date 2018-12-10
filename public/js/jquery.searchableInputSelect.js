// Author: David Qin
// E-mail: david@hereapp.cn
// Date: 2014-11-05

(function($){

  // a case insensitive jQuery :contains selector
  $.expr[":"].searchableSelectContains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
      return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
  });

  $.searchableInputSelect = function(element, options) {
    this.element = element;
    this.options = options || {};
    this.init();

    var _this = this;

    this.searchableElement.click(function(event){
      // event.stopPropagation();
      _this.showInput();
    }).on('keydown', function(event){
      if (event.which === 13 || event.which === 40 || event.which == 38){
        event.preventDefault();
        _this.showInput();
      }
    });

    $(document).on('click', null, function(event){
      if(_this.searchableElement.has($(event.target)).length === 0)
        _this.hideInput();
    });

    this.input.on('keydown', function(event){
      event.stopPropagation();
      if(event.which === 13){         //enter
        event.preventDefault();
        _this.selectInputCurrentHoverItem();
        _this.hideInput();
      } else if (event.which == 27) { //ese
        _this.hideInput();
      } else if (event.which == 40) { //down
        _this.hoverNextItemInput();
      } else if (event.which == 38) { //up
        _this.hoverPreviousItemInput();
      }
    }).on('keyup', function(event){
      if(event.which != 13 && event.which != 27 && event.which != 38 && event.which != 40)
        _this.filterInput();
    })
  }

  var $sS = $.searchableInputSelect;

  $sS.fn = $sS.prototype = {
    version: '0.0.1'
  };

  $sS.fn.extend = $sS.extend = $.extend;

  $sS.fn.extend({
    init: function(){
      var _this = this;
      this.element.hide();

      this.searchableElement = $('<div tabindex="0" class="searchable-select" id="searchable-select"></div>');
      this.holder = $('<div class="searchable-select-holder"  id="select-holder"></div>');
      this.dropdown = $('<div class="searchable-select-dropdown searchable-select-hide" style="position: relative ;z-index:100;top: 0px;"></div>');
      this.input = $('<input type="text" class="searchable-select-input" />');
      this.items = $('<div class="searchable-select-items" id="select-items"></div>');
      this.caret = $('<span class="searchable-select-caret"></span>');

      this.scrollPart = $('<div class="searchable-scroll"></div>');
      this.hasPrivious = $('<div class="searchable-has-privious">...</div>');
      this.hasNext = $('<div class="searchable-has-next" style="display: none">...</div>');

      this.hasNext.on('mouseenter', function(){
        _this.hasNextTimer = null;

        var f = function(){
          var scrollTop = _this.items.scrollTop();
          _this.items.scrollTop(scrollTop + 20);
          _this.hasNextTimer = setTimeout(f, 50);
        }

        f();
      }).on('mouseleave', function(event) {
        clearTimeout(_this.hasNextTimer);
      });

      this.hasPrivious.on('mouseenter', function(){
        _this.hasPriviousTimer = null;

        var f = function(){
          var scrollTop = _this.items.scrollTop();
          _this.items.scrollTop(scrollTop - 20);
          _this.hasPriviousTimer = setTimeout(f, 50);
        }

        f();
      }).on('mouseleave', function(event) {
        clearTimeout(_this.hasPriviousTimer);
      });

      this.dropdown.append(this.input);
      this.dropdown.append(this.scrollPart);

      this.scrollPart.append(this.hasPrivious);
      this.scrollPart.append(this.items);
      this.scrollPart.append(this.hasNext);

      this.searchableElement.append(this.caret);
      this.searchableElement.append(this.holder);
      this.searchableElement.append(this.dropdown);
      this.element.after(this.searchableElement);

      this.buildItems();
      this.setPriviousAndNextVisibilityInput();
    },

    filterInput: function(){
      var text = this.input.val();
      this.items.find('.searchable-select-item').addClass('searchable-select-hide');
      this.items.find('.searchable-select-item:searchableSelectContains('+text+')').removeClass('searchable-select-hide');
      if(this.currentSelectedItem.hasClass('searchable-select-hide') && this.items.find('.searchable-select-item:not(.searchable-select-hide)').length > 0){
        this.hoverFirstNotHideItemInput();
      }

      this.setPriviousAndNextVisibilityInput();
    },

      hoverFirstNotHideItemInput: function(){
      this.hoverItemInput(this.items.find('.searchable-select-item:not(.searchable-select-hide)').first());
    },

      selectInputCurrentHoverItem: function(){
      if(!this.currentHoverItem.hasClass('searchable-select-hide'))
        this.selectItemInput(this.currentHoverItem);
    },

      hoverPreviousItemInput: function(){
      if(!this.hasCurrentHoverItemInput())
        this.hoverFirstNotHideItemInput();
      else{
        var prevItem = this.currentHoverItem.prevAll('.searchable-select-item:not(.searchable-select-hide):first')
        if(prevItem.length > 0)
          this.hoverItemInput(prevItem);
      }
    },

    hoverNextItemInput: function(){
      if(!this.hasCurrentHoverItemInput())
        this.hoverFirstNotHideItemInput();
      else{
        var nextItem = this.currentHoverItem.nextAll('.searchable-select-item:not(.searchable-select-hide):first')
        if(nextItem.length > 0)
          this.hoverItemInput(nextItem);
      }
    },

    buildItems: function(){
      var _this = this;
      this.element.find('option').each(function(){
        var item = $('<div class="searchable-select-item" data-url="'+$(this).attr('data-url')+'" data-value="'+$(this).attr('value')+'">'+$(this).text()+'</div>');

        if(this.selected){
          _this.selectItemInput(item);
          _this.hoverItemInput(item);
        }

        item.on('mouseenter', function(){
          $(this).addClass('hover');
        }).on('mouseleave', function(){
          $(this).removeClass('hover');
        }).click(function(event){
          event.stopPropagation();
          _this.selectItemInput($(this));
          _this.hideInput();
        });

        _this.items.append(item);
      });

      this.items.on('scroll', function(){
        _this.setPriviousAndNextVisibilityInput();
      })
    },
    showInput: function(){
      this.dropdown.removeClass('searchable-select-hide');
      this.input.focus();
      this.status = 'show';
      this.setPriviousAndNextVisibilityInput();
    },

    hideInput: function(){
      if(!(this.status === 'show'))
          return;

      if(this.items.find(':not(.searchable-select-hide)').length === 0)
          var value = this.input.val();
          if(value != undefined){
              this.holder.text(value);
              var item = $('<div class="searchable-select-item selected" data-url="'+undefined+'" data-value="'+value+'">'+value+'</div>');
              this.currentSelectedItem.removeClass('selected');
              this.items.append(item);
              this.scrollPart.addClass('has-next');
              var optionitem = $('<option selected="" value="'+value+'">'+value+'</option>');
              this.element.find('option').append(optionitem);
          }
          var holderval = this.holder.text();
          this.element.val(holderval);  //当选单没有这个键值，则value为 null
          this.dropdown.addClass('searchable-select-hide');
          this.status = 'hide';
          // this.dropdown.text(value);
          // this.items.text(value);
        // document.getElementById("select").val(value);
    },

    hasCurrentSelectedItemInput: function(){
      return this.currentSelectedItem && this.currentSelectedItem.length > 0;
    },

    selectItemInput: function(item){
      if(this.hasCurrentSelectedItemInput())
        this.currentSelectedItem.removeClass('selected');

      this.currentSelectedItem = item;
      item.addClass('selected');

      this.hoverItemInput(item);

      this.holder.text(item.text());
      var value = item.data('value');
      this.holder.data('value', value);
      this.element.val(value);

      if(this.options.afterSelectItem){
        this.options.afterSelectItem.apply(this);
      }
    },

    hasCurrentHoverItemInput: function(){
      return this.currentHoverItem && this.currentHoverItem.length > 0;
    },

    hoverItemInput: function(item){
      if(this.hasCurrentHoverItemInput())
        this.currentHoverItem.removeClass('hover');

      if(item.outerHeight() + item.position().top > this.items.height())
        this.items.scrollTop(this.items.scrollTop() + item.outerHeight() + item.position().top - this.items.height());
      else if(item.position().top < 0)
        this.items.scrollTop(this.items.scrollTop() + item.position().top);

      this.currentHoverItem = item;
      item.addClass('hover');
    },

    setPriviousAndNextVisibilityInput: function(){
      if(this.items.scrollTop() === 0){
        this.hasPrivious.addClass('searchable-select-hide');
        this.scrollPart.removeClass('has-privious');
      } else {
        this.hasPrivious.removeClass('searchable-select-hide');
        this.scrollPart.addClass('has-privious');
      }

      if(this.items.scrollTop() + this.items.innerHeight() >= this.items[0].scrollHeight){
        this.hasNext.addClass('searchable-select-hide');
        this.scrollPart.removeClass('has-next');
      } else {
        this.hasNext.removeClass('searchable-select-hide');
        this.scrollPart.addClass('has-next');
      }
    }
  });

  $.fn.searchableInputSelect = function(options){
    this.each(function(){
      var sS = new $sS($(this), options);
    });

    return this;
  };

})(jQuery);
