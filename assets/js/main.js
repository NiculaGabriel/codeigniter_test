window.addEventListener('load', function(e){
	  
    $("input.datepicker").datepicker();
  	
    const _selectOption = (function(){
    	return {
    		main:function()
    		{
    			this.addSelectClickEvent( this.getFormElement('select#sex') );
    		},
    		getFormElement(selector)
    		{
    			return ( document.querySelector(selector) ? document.querySelector(selector) : false )
    		},
    		addSelectClickEvent:function(item)
    		{
    			if(item)
    			{
    				var _self = this;
	    			item.addEventListener('change', function(e){
	    				 const input = _self.getFormElement('input[name="sex"]');	    				  
	    				 input.setAttribute('value', this.value);
	    				 input.value = this.value;
	    			});
    			}
    		}
    	}
    })();

    _selectOption.main();

	const __validateForm = (function(){
	 		return { 			
 
	 			main:function(object)
	 			{ 
	 				if(!this.isEmpty(object))
	 				{
	 					this.addSubmitFormEvent( this.getForm(object), object.fields );
	 				}
	 			},
	 			removeAllMessages:function(){
	 				const items = document.querySelectorAll('div.alert')
	 				for(var i in items){
	 					if(items[i].tagName == 'DIV')
	 					{ 
		 					items[i].remove();
	 					}
	 				}
	 			},
	 			getForm:function(object)
	 			{
	 				return ( document.querySelector(object.form) ? document.querySelector(object.form) : false );
	 			},
	 			getElement:function(selector)
	 			{
	 				return( document.querySelector(selector) ? document.querySelector(selector) : false );	 			 
	 			},
	 			addSubmitFormEvent:function(item, fields)
	 			{
	 				if(item && !this.isEmpty(fields))
	 				{
	 					var _self = this;
	 					item.addEventListener('submit', function(e)
	 					{	 		
	 						// e.preventDefault();				 
	 						const result =_self.validateFields(fields);
	 						if(!result) {
	 							e.preventDefault();
	 						}
	 					});
	 				}
	 			},
	 			validateFields:function(fields)
	 			{
	 				return this.iterateFields(fields);
	 			},
	 			iterateFields:function(fields)
	 			{
	 				var result = true;
	 				for(var f in fields)
	 				{
	 					const element = this.getElement(fields[f].type + '[name="' + fields[f].name + '"]');
	 					this.removeMessage(element);
	 					var flag = true
	 					for( var m in fields[f]['methods'] )
	 					{
	 						if(flag)
	 						{
	 						   flag = this[fields[f]['methods'][m]](element);
	 						   result = flag;
	 						}
	 					}
	 				}
 
	 				return result;
	 			},
	 			isEmptyValue:function(element)
	 			{ 
	 				const result = ( element && element.value.length ? true : false );	 				 
	 				if(!result){
	 					 this.insertMessage(element, 'Nu lasa acest camp gol!');
	 				}	 				 
	 				return result;
	 			},
	 			isCnpValue:function(element)
	 			{
	 				const pattern = /^[1-9]\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])(0[1-9]|[1-4]\d|5[0-2]|99)(00[1-9]|0[1-9]\d|[1-9]\d\d)\d$/g;
	 				const result = ( element.value.match(pattern) ? true : false );	 				 
	 				if(!result) {
	 					this.insertMessage(element, 'Nu este un CNP valid!');
	 				}
	 				return result;
	 			},
	 			isEmailValue:function(element)
	 			{
	 				const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	 				const result = ( element.value.match(pattern) ? true : false );
	 				if(!result) {
	 					this.insertMessage(element, 'Adresa de e-mail nu este valida!');
	 				}
	 				return result;
	 			},
	 			insertMessage:function(element, message)
	 			{
	 				if(element) {
		 				const parent = element.closest('.form-group');
		 				if(parent)
		 				{
		 				   const _div = document.createElement('div');
		 				   		 _div.classList.add('alert');
		 				   		 _div.classList.add('alert-danger');
		 				   		 _div.classList.add('mt-2');
		 				   		 _div.setAttribute('role', 'alert');
		 				   		 _div.textContent = message;
		 				   		 parent.append(_div);
		 				}
	 				}
	 			},
	 			removeMessage:function(element)
	 			{
	 				if( element && element.tagName ) 
	 				{
		 				const parent = element.closest('.form-group');
		 				if(parent)
		 				{
		 					const items = parent.querySelectorAll('.alert');
		 					for(var i in items)
		 					{
		 						if(
		 							items[i] && 
		 							items[i].tagName == 'DIV'
		 						){
		 							items[i].remove();
		 						}
		 					}
		 				}
	 				}
	 			},
	 			isEmpty: function(object) 
				{
				  	if (object == null){
				  	    return true
				  	};
				  	if(JSON.stringify(object).length === JSON.stringify({}).length )
				  	{
				  		return true;
				  	}
				  	return false;
				},
	 		}
	})();

	__validateForm.main({ 
	 		'form'   : 'form#new-contract',
	 		'fields' :  [
	 			{
	 			   'name'   : 'nume',
	 			   'methods' : ['isEmptyValue'],
	 			   'type'   : 'input'
	 			},
	 			{
	 			   'name'  : 'sex',
	 			   'methods' : ['isEmptyValue'],
	 			   'type'   : 'input'
	 			},
	 			{
	 			   'name'  : 'cnp',
	 			   'methods': [ 'isEmptyValue', 'isCnpValue'],
	 			   'type'   : 'input'
	 			},
	 			{
	 			   'name'  : 'email',
	 			   'methods': [ 'isEmptyValue', 'isEmailValue'],
	 			   'type'   : 'input'
	 			},

	 		] 
	});
 
	 
	 const _addPhoneNumberOnTheFly = (function(){

	 	return {

	 		removeButtonsCount : 0,

	 		main:function()
	 		{
	 			this.addButtonAddPhoneEventClick(this.getPlusButton());
	 		},
	 		init:function(){
	 			const items = this.getAllRemoveButtons();
	 			this.iterateAllRemoveButtons(items);
	 		},
	 		getPlusButton:function()
	 		{
	 			return ( document.querySelector('.add-phone') ? document.querySelector('.add-phone') : false );
	 		},
	 		getAllRemoveButtons:function(){
	 			return ( document.querySelectorAll('.remove-phone') ? document.querySelectorAll('.remove-phone') : false )
	 		},
	 		iterateAllRemoveButtons:function(items)
	 		{
	 			for( var i in items)
	 			{
	 				if(
	 					items[i] && 
	 					items[i].tagName == 'BUTTON'
	 				){
	 					this.addRemoveAddPhoneEventClick(items[i]);
	 				}
	 			}
	 		},
	 		addRemoveAddPhoneEventClick:function(item)
	 		{
	 			var _self = this;
	 			item.addEventListener('click', function(e){
	 				if(this.closest('.form-group'))
	 				{
	 					this.closest('.form-group').remove();
	 				}
	 			});
	 		},
	 		addButtonAddPhoneEventClick:function(element)
	 		{
	 			if(element){
		 			var _self = this;
		 			element.addEventListener('click', function(e){
		 				_self.addInputField(this, _self.generateInputField());
		 				// _self.init();
		 			});
	 			}
	 		},
	 		generateInputField:function(){
	 			const formGroup = document.createElement('div');	 				   
	 				  formGroup.classList.add('form-group');
	 				  formGroup.classList.add('mt-2');
	 			const group = document.createElement('div');
	 				  group.setAttribute('class', 'group');
	 			const input = document.createElement('input');
	 				  input.setAttribute('type', 'tel');
	 				  input.setAttribute('class', 'form-control');
	 				  input.setAttribute('name', 'tel\[\]');
	 				  input.setAttribute('placeholder', 'Adauga telefon');
	 			const buttonRemove = document.createElement('button');
	 				  buttonRemove.setAttribute('type', 'button');
	 				  buttonRemove.classList.add('remove-phone');
	 				  buttonRemove.classList.add('btn');
	 				  buttonRemove.classList.add('btn-primary');
	 				  buttonRemove.textContent = '-';

		 			  group.append(input);
		 			  group.append(buttonRemove);
		 			  formGroup.append(group);
	 				  return formGroup;
	 		},
	 		addInputField:function(element, group)
	 		{
	 			const form = element.closest('form');	 			 
	 			if(form)
	 			{
	 				$result = form.insertBefore(group, document.querySelector('form button.submit'));
	 				if($result){
	 				   this.addClickEventRemoveInput($result);
	 				}
	 			}
	 		},
	 		addClickEventRemoveInput:function(item)
	 		{
	 			const btn = item.querySelector('.remove-phone');
	 			if(btn){
	 			   btn.addEventListener('click', function(e){
	 			   		if( this.closest('.form-group') ) 
	 			   		{
		 				    this.closest('.form-group').remove();
		 				}
	 			   });
	 			}
	 		}
	 	}

	 })();
	 _addPhoneNumberOnTheFly.init();
	 _addPhoneNumberOnTheFly.main();

	 const _dropDown = (function(){
	 	return {
	 		main:function(object)
	 		{
 			 	if(!this.isEmpty(object))
 				{
 					this.iterateObject(object);
 				}
	 		},
	 		iterateObject:function(object)
	 		{
	 			for(var o in object)
	 			{
	 				this.prepareEventOnElement(object[o]);
	 			}
	 		},
	 		prepareEventOnElement:function(object)
	 		{
	 			const element = this.getDropDownElement(object['dropdown']);
	 			if(
	 				element &&
	 				element.tagName
	 			){
	 				this.addEventOnElement(element, object);
	 			}
	 		},
	 		addEventOnElement(element, object)
	 		{
	 			var _self = this;
	 			element.addEventListener(object.event, function(e)
	 			{
	 				if(e.target.tagName == 'A') {
	 					if( e.target.dataset.value ) {
	 						_self.populateHiddenInputElement(e.target.dataset.value, object);
	 					    _self.switchPosition(e.target);
	 					}
	 					_self.addCancelFilter(e.target);
	 					_self.addClickEventCnacelFilter(e.target);
	 				}
	 			});
	 		},
	 		populateHiddenInputElement:function(value, object){
				const _hidden = this.getDropDownElement(object['hidden']);
				if(
					_hidden &&
					_hidden.tagName == 'INPUT'
				)
				{
					_hidden.setAttribute('value', value);
					_hidden.value = value;
				}
	 		},
	 		getDropDownElement: function(selector)
	 		{
	 			return ( document.querySelector(selector) ? document.querySelector(selector) : false );
	 		},
	 		switchPosition(element)
	 		{
	 			if( !element.classList.contains('cancel-filters') )
	 			{
		 			const _parent = element.closest('.choose-type');
		 			if(_parent)
		 			{
		 				this.removeDisplayNone(_parent);
		 				const _placeholder = _parent.querySelector('a.dropdown-toggle');
		 				_placeholder.textContent = element.textContent;
		 				if(element.dataset.value){
						   element.classList.add('d-none');
		 				}
		 			}
	 			}
	 		},
	 		removeDisplayNone:function(_parent)
	 		{
	 			const items = _parent.querySelectorAll('.dropdown-menu a');
	 			for(var i in items)
	 			{
	 				if(
	 					items[i] &&
	 					items[i].tagName == 'A' &&
	 					items[i].classList.contains('d-none')
	 				){
	 					items[i].classList.remove('d-none')
	 				}
	 			}
	 		},
	 		addCancelFilter:function(element)
	 		{
	 			if(element.dataset.value)
	 			{
		 			const _parent = element.closest('.choose-type');
		 			if(!_parent.querySelector('.cancel-filters'))
		 			{
		 			const _cancel = document.createElement('a');
		 				  _cancel.setAttribute('href', 'javascript:void(0)');
		 				  _cancel.classList.add('dropdown-item');
		 				  _cancel.classList.add('cancel-filters');
		 				  _cancel.textContent = 'ANULEAZA FILTRELE'
		 				  if(_parent.querySelector('.dropdown-menu'))
		 				  {
		 				  	 _parent.querySelector('.dropdown-menu').append(_cancel);
		 				  }
	 				}
	 			}
	 		},
	 		addClickEventCnacelFilter:function(element)
	 		{
	 			if(element.classList.contains('cancel-filters'))
	 			{
	 				var flag  = false;
	 				var _form = element.closest('form');
	 				var _hiddenInputs = this.getAllInput(_form);
	 				for(var i in _hiddenInputs)
	 				{
	 					if(
	 						_hiddenInputs[i] &&
	 						_hiddenInputs[i].tagName == 'INPUT'
	 					)
	 					{
	 						if( 
	 							_hiddenInputs[i].getAttribute('name') != 'rows' &&
	 							_hiddenInputs[i].getAttribute('name') != 'sortby' 
	 						)
	 						{
	 							_hiddenInputs[i].removeAttribute('name');
	 							_hiddenInputs[i].setAttribute('value', '');
	 							_hiddenInputs[i].value = '';
	 						}
	 						else{
	 							if(_hiddenInputs[i].value.length || _hiddenInputs[i].getAttribute('value').length)
	 							{
	 								flag = true;
	 							}
	 						}
	 					}
	 				}
	 				if(!flag){
	 					var _url = _form.getAttribute('action');
	 				   _form.setAttribute('action', (_form.getAttribute('action').replace(/\/filter/g,'') ) );
	 				   _form.setAttribute('method', 'POST');
	 				}
	 				_form.submit();
	 			}
	 		},
	 		getAllInput(_form){
	 			return _form.querySelectorAll('input');
	 		},
	 		isEmpty: function(object) 
			{
			  	if (object == null){
			  	    return true
			  	};
			  	if(JSON.stringify(object).length === JSON.stringify({}).length )
			  	{
			  		return true;
			  	}
			  	return false;
			},

	 	}
	 })();

	 _dropDown.main([
	 	{
	 		'dropdown' : '.choose-type',
	 		'hidden'   : 'input[name="type"]',
	 		'event'    : 'click'
	 	}
	 ]);

	 // const _searchFilter = (function(){
	 // 	return {
	 // 		main:function()
	 // 		{
	 // 			const _form = this.getSearchForm()
	 // 			if(_form)
	 // 			{
	 // 				this.addEventSubmit(_form);
	 // 			}
	 // 		},
	 // 		getFormInputElements:function()
	 // 		{
	 // 			return document.querySelectorAll('form.form-inline input');
	 // 		},
	 // 		getSearchForm:function()
	 // 		{
	 // 			return (document.querySelector('form.form-inline') ? document.querySelector('form.form-inline') : false );
	 // 		},
	 // 		addEventSubmit:function(element)
	 // 		{
	 // 			var _self = this;
		//  		element.addEventListener('submit', function(e){
		//  			// e.preventDefault();
		//  			const elements = _self.getFormInputElements();
		//  			var action = this.getAttribute('action');
		//  			for(var i in elements ){
		//  				if(
		//  					elements[i] &&
		//  					elements[i].tagName
		//  				){
		//  					if(elements[i].value.length){
		//  						action += '/' + elements[i].value;
		//  					}
		//  				}
		//  			} 
		//  			this.setAttribute('action', action);
		//  		});
	 // 		},

	 // 	}
	 // })();

	 // _searchFilter.main();
});
 