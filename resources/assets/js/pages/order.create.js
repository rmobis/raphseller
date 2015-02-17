/* global LANG */
$(function() {
	'use strict';

	var emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	var innerCover = $('.inner.cover'),
	    heading    = $('.cover-heading'),
	    licenses   = $('.license'),
	    hiddenDays = $('#license-days'),
	    email      = $('.email'),
	    forumName  = $('.forum-name');

	licenses.on('click', function () {
		var $this = $(this);

		licenses.removeClass('active');
		$this.addClass('active');

		if (innerCover.hasClass('on-step-one')) {
			stepTwo();
			
			email.trigger('input');
		}

		hiddenDays.val($this.data('days'));
		email.focus();
	});

	email.on('input', $.debounce(200, function () {
		if (emailRegex.test($(this).val()) === false) {
			stepTwo();
		} else if (innerCover.hasClass('on-step-two')) {
			stepThree();
			
			forumName.trigger('input');
		}
	}));

	forumName.on('input', $.debounce(400, function () {
		if ($(this).val().length < 3) {
			stepThree();
		} else if (innerCover.hasClass('on-step-three')) {
			stepFour();
		}
	}));

	function stepOne() {
		/* Correct step class */
		innerCover.addClass('on-step-one');
		innerCover.removeClass('on-step-two');
		innerCover.removeClass('on-step-three');
		innerCover.removeClass('on-step-four');

		heading.html(LANG.STEP_ONE);
	}

	function stepTwo() {
		/* Correct step class */
		innerCover.removeClass('on-step-one');
		innerCover.addClass('on-step-two');
		innerCover.removeClass('on-step-three');
		innerCover.removeClass('on-step-four');

		heading.html(LANG.STEP_TWO);
	}

	function stepThree() {
		/* Correct step class */
		innerCover.removeClass('on-step-one');
		innerCover.removeClass('on-step-two');
		innerCover.addClass('on-step-three');
		innerCover.removeClass('on-step-four');

		heading.html(LANG.STEP_THREE);
	}

	function stepFour() {
		/* Correct step class */
		innerCover.removeClass('on-step-one');
		innerCover.removeClass('on-step-two');
		innerCover.removeClass('on-step-three');
		innerCover.addClass('on-step-four');

		heading.html(LANG.STEP_FOUR);
	}

	/* Start at the beginning */
	stepOne();

	/* In case we sent input back */
	if (hiddenDays.val()) {
		licenses.filter('[data-days=' + hiddenDays.val() + ']').trigger('click');
	}
});