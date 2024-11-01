jQuery(document).ready(function($){
	modalHtml =
                    '<div class="emd-modal emd-modal-deactivation-feedback">'
                    + ' <div class="emd-modal-dialog">'
                    + '         <div class="emd-modal-body">'
                    + '                 <div class="emd-modal-panel active" data-panel-id="reasons"><h3><strong>' + feedback_vars.msg + '</strong></h3><ul id="reasons-list">' + feedback_vars.reasons + '</ul></div>'
                    + '         </div>'
                    + '         <div class="emd-modal-footer">'
		    + '			<div style="font-size:80%;text-align:left;padding-bottom:5px">' + feedback_vars.disclaimer + '</div>'
                    + '                 <div>'
		    + '			<a href="#" class="button button-secondary button-deactivate">'+ feedback_vars.skip + '</a>'
                    + '                 <a href="#" class="button button-primary button-close">'+ feedback_vars.cancel +'</a>'
                    + '         	</div>'
                    + '         </div>'
                    + ' </div>'
                    + '</div>',
	$modal = $(modalHtml),
	$deactivateLink = $('i.wpas-slug').parent().find('a');
	$modal.appendTo($('body'));

	$deactivateLink.click(function (e) {
		e.preventDefault();
		resetModal();
		$modal.addClass('active');
		$('body').addClass('has-emd-modal');
        });
	$modal.on('click', '.emd-modal-footer .button', function (e) {
		e.preventDefault();
		if($(this).hasClass('disabled')){
			return;
		}

		var _parent = $(this).parents('.emd-modal:first');
		if($(this).hasClass('allow-deactivate')) {
			var $radio = $('input[type="radio"]:checked');

			if (0 === $radio.length) {
				// If no selected reason, just deactivate the plugin.
				window.location.href = $deactivateLink.attr('href');
				return;
			}

			var $selected_reason = $radio.parents('li:first'),
			    $input = $selected_reason.find('textarea, input[type="text"]'),
			    userReason = ( 0 !== $input.length ) ? $input.val().trim() : '';

			if (isOtherReasonSelected() && ( '' === userReason )) {
				return;
			}
			$.ajax({
				url       : ajaxurl,
				method    : 'POST',
				data      : {
					'action'     : 'wpas_send_deactivate_reason',
					'reason_id'  : $radio.val(),
					'plugin_name'  : 'wpas',
					'reason_info': userReason
				},
				beforeSend: function () {
					_parent.find('.emd-modal-footer .button').addClass('disabled');
					_parent.find('.emd-modal-footer .button-secondary').text('Processing...');
				},
				complete  : function () {
					// Do not show the dialog box, deactivate the plugin.
					window.location.href = $deactivateLink.attr('href');
				}
			});
		}
		else if ($(this).hasClass('button-deactivate')) {
			_parent.find('.button-deactivate').addClass('allow-deactivate');
			showPanel('reasons');
		}
	});
	//If clicked outside modal, cancel it.
	$modal.on('click', function (e) {
		var $target = $(e.target);
		// If the user has clicked anywhere in the modal dialog, just return.
		if ($target.hasClass('emd-modal-body') || $target.hasClass('emd-modal-footer')) {
			return;
		}
		// If the user has not clicked the close button and the clicked element is inside the modal dialog, just return.
		if (!$target.hasClass('button-close') && ( $target.parents('.emd-modal-body').length > 0 || $target.parents('.emd-modal-footer').length > 0 )) {
			return;
		}
		$modal.removeClass('active');
		$('body').removeClass('has-emd-modal');
	});
	$modal.on('input propertychange', '.reason-input input', function () {
		if (!isOtherReasonSelected()) {
			return;
		}
		var reason = $(this).val().trim();

		if (reason.length > 0) {
			$('.message').removeClass('error-message');
			$modal.find('.button-deactivate').removeClass('disabled');
		}
	});
	$modal.on('blur', '.reason-input input', function () {
		var $userReason = $(this);
		setTimeout(function () {
			if (!isOtherReasonSelected()) {
				return;
			}
			if (0 === $userReason.val().trim().length) {
				$('.message').addClass('error-message');
				$modal.find('.button-deactivate').addClass('disabled');
			}
		}, 150);
	});
	$modal.on('click', 'input[type="radio"]', function () {
		var $selectedReasonOption = $(this);

		// If the selection has not changed, do not proceed.
		if (false === $selectedReasonOption.val())
			return;

		selectedReasonID = $selectedReasonOption.val();

		var _parent = $(this).parents('li:first');

		$modal.find('.reason-input').remove();
		$modal.find('.button-deactivate').text(feedback_vars.submit);

		$modal.find('.button-deactivate').removeClass('disabled');

		if (_parent.hasClass('has-input')) {
			var inputType = _parent.data('input-type'),
			    inputPlaceholder = _parent.data('input-placeholder'),
			    reasonInputHtml = '<div class="reason-input"><span class="message"></span>' + ( ( 'textfield' === inputType ) ? '<input type="text" />' : '<textarea rows="5"></textarea>' ) + '</div>';

			_parent.append($(reasonInputHtml));
			_parent.find('input, textarea').attr('placeholder', inputPlaceholder).focus();

			if (isOtherReasonSelected()) {
				$modal.find('.message').text(feedback_vars.ask_reason).show();
				$modal.find('.button-deactivate').addClass('disabled');
			}
		}
	});

	function showPanel(panelType) {
		$modal.find('.emd-modal-panel').removeClass('active ');
		$modal.find('[data-panel-id="' + panelType + '"]').addClass('active');
		$modal.find('.button-deactivate').text(feedback_vars.skip);
	}
	function isOtherReasonSelected() {
		var $selectedReasonOption = $modal.find('input[type="radio"]:checked'),
		selectedReason = $selectedReasonOption.parent().next().text().trim();
		return ( 'Other' === selectedReason );
	}
	function resetModal() {
		selectedReasonID = false;
		$modal.find('.button-deactivate').removeClass('disabled');
		// Uncheck all radio buttons.
		$modal.find('input[type="radio"]').prop('checked', false);
		// Remove all input fields ( textfield, textarea ).
		$modal.find('.reason-input').remove();
		$modal.find('.message').hide();
		var $deactivateButton = $modal.find('.button-deactivate');
		$deactivateButton.addClass('allow-deactivate');
		showPanel('reasons');
	}
});
