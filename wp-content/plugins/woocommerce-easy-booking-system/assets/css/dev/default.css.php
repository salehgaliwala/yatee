<?php

defined( 'ABSPATH' ) || exit;

header("Content-type: text/css; charset: UTF-8");

$background_color = get_option( 'wceb_background_color');
$main_color       = get_option( 'wceb_main_color');
$text_color       = get_option( 'wceb_text_color');

?>
/* ==========================================================================
   Reset styles to prevent conflict with themes
   ========================================================================== */

input[readonly] {
    cursor: pointer !important;
}

table.picker_table th, table.picker__table tr, table.picker__table td {
  background: none !important;
  border: none !important;
  margin: 0 !important;
  padding: 0 !important;
  border: none !important;
  font-size: 16px !important;
}

.picker, .picker > * {
  outline: none;
}

/* ==========================================================================
   $BASE-PICKER
   ========================================================================== */
/**
 * Note: the root picker element should __NOT__ be styled
 * more than what’s here. Style the `.picker__holder` instead.
 */

.picker {
  font-size: 16px;
  text-align: left;
  line-height: 1.2;
  color: <?php echo wc_format_hex( $text_color ); ?>;
  position: absolute;
  z-index: 10000;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  outline: none;
}

/**
 * The picker input element.
 */
.picker__input {
  cursor: default;
}
/**
 * When the picker is opened, the input element is “activated”.
 */
.picker__input.picker__input--active {
  border-color: <?php echo wc_format_hex( $main_color ); ?>;
}
/**
 * The holder is the only “scrollable” top-level container element.
 */
.picker__holder {
  width: 100%;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
}

/*!
 * Default mobile-first, responsive styling for pickadate.js
 * Demo: http://amsul.github.io/pickadate.js
 */
/**
 * Make the holder and frame fullscreen.
 */
.picker__holder,
.picker__frame {
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  -ms-transform: translateY(100%);
      transform: translateY(100%);
}
/**
 * The holder should overlay the entire screen.
 */
.picker__holder {
  position: fixed;
  transition: background 0.15s ease-out, transform 0s 0.15s;
  -webkit-backface-visibility: hidden;
}
/**
 * The frame that bounds the box contents of the picker.
 */
.picker__frame {
  position: absolute;
  margin: 0 auto;
  min-width: 256px;
  max-width: 666px;
  width: 100%;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -moz-opacity: 0;
  opacity: 0;
  transition: all 0.15s ease-out;
}
@media (min-height: 33.875em) {
  .picker__frame {
    overflow: visible;
    top: auto;
    bottom: -100%;
    max-height: 80%;
  }
}
@media (min-height: 40.125em) {
  .picker__frame {
    margin-bottom: 7.5%;
  }
}
/**
 * The wrapper sets the stage to vertically align the box contents.
 */
.picker__wrap {
  display: table;
  width: 100%;
  height: 100%;
}
@media (min-height: 33.875em) {
  .picker__wrap {
    display: block;
  }
}
/**
 * The box contains all the picker contents.
 */
.picker__box {
  background:<?php echo wc_format_hex( $background_color ); ?>;
  display: table-cell;
  vertical-align: middle;
}
@media (min-height: 26.5em) {
  .picker__box {
    font-size: 1.25em;
  }
}
@media (min-height: 33.875em) {
  .picker__box {
    font-size: 1.33em;
    border: 1px solid <?php echo wc_hex_darker( $background_color, 150 ); ?>;
    border-top-color: <?php echo wc_hex_darker( $background_color, 125 ); ?>;
    border-bottom-width: 0;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 12px 36px 16px rgba(0, 0, 0, 0.24);
  }
}
@media (min-height: 40.125em) {
  .picker__box {
    font-size: 1.5em;
    border-bottom-width: 1px;
    border-radius: 5px;
  }
}
/**
 * When the picker opens...
 */
.picker--opened .picker__holder {
  -ms-transform: translateY(0);
      transform: translateY(0);
  background: transparent;
  -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#1E000000,endColorstr=#1E000000)";
  zoom: 1;
  background: rgba(0, 0, 0, 0.32);
  transition: background 0.15s ease-out;
}
.picker--opened .picker__frame {
  -ms-transform: translateY(0);
      transform: translateY(0);
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  -moz-opacity: 1;
  opacity: 1;
}
@media (min-height: 33.875em) {
  .picker--opened .picker__frame {
    top: auto;
    bottom: 0;
  }
}
/**
 * For `large` screens, transform into an inline picker.
 */

 /* ==========================================================================
   $BASE-DATE-PICKER
   ========================================================================== */
/**
 * The picker box.
 */
.picker__box {
  padding: 0 1em;
}
/**
 * The header containing the month and year stuff.
 */
.picker__header {
  text-align: center;
  position: relative;
  margin-top: .75em;
}
/**
 * The month and year labels.
 */
.picker__month,
.picker__year {
  font-weight: 500;
  display: inline-block;
  margin-left: .25em;
  margin-right: .25em;
}
.picker__year {
  color: <?php echo wc_hex_darker( $background_color, 100 ); ?>;
  font-size: .8em;
  font-style: italic;
}
/**
 * The month and year selectors.
 */
select.picker__select--month,
select.picker__select--year {
  border: 1px solid <?php echo wc_hex_darker( $background_color, 50 ); ?>;
  height: 2em;
  margin-left: .25em;
  margin-right: .25em;
}
@media (min-width: 24.5em) {
  select.picker__select--month,
  select.picker__select--year {
    margin-top: -0.5em;
  }
}
select.picker__select--month {
  width: 35%;
}
select.picker__select--year {
  width: 22.5%;
}
select.picker__select--month:focus,
select.picker__select--year:focus {
  border-color: <?php echo wc_format_hex( $main_color ); ?>;
}
/**
 * The month navigation buttons.
 */
.picker__nav--prev,
.picker__nav--next {
  position: absolute;
  padding: .5em 1.25em;
  width: 1em;
  height: 1em;
  box-sizing: content-box;
  top: -0.25em;
}
@media (min-width: 24.5em) {
  .picker__nav--prev,
  .picker__nav--next {
    top: -0.33em;
  }
}
.picker__nav--prev {
  left: -1em;
  padding-right: 1.25em;
}
@media (min-width: 24.5em) {
  .picker__nav--prev {
    padding-right: 1.5em;
  }
}
.picker__nav--next {
  right: -1em;
  padding-left: 1.25em;
}
@media (min-width: 24.5em) {
  .picker__nav--next {
    padding-left: 1.5em;
  }
}
.picker__nav--prev:before,
.picker__nav--next:before {
  content: " ";
  border-top: .5em solid transparent;
  border-bottom: .5em solid transparent;
  border-right: 0.75em solid <?php echo wc_format_hex( $text_color ); ?>;
  width: 0;
  height: 0;
  display: block;
  margin: 0 auto;
}
.picker__nav--next:before {
  border-right: 0;
  border-left: 0.75em solid <?php echo wc_format_hex( $text_color ); ?>;
}
.picker__nav--prev:hover,
.picker__nav--next:hover {
  cursor: pointer;
  color: <?php echo wc_format_hex( $text_color ); ?>;
  background: <?php echo wc_hex_lighter( $main_color, 75 ); ?>;
}
.picker__nav--disabled,
.picker__nav--disabled:hover,
.picker__nav--disabled:before,
.picker__nav--disabled:before:hover {
  cursor: default;
  background: none;
  border-right-color: <?php echo wc_hex_darker( $background_color, 10 ); ?>;
  border-left-color: <?php echo wc_hex_darker( $background_color, 10 ); ?>;
}
/**
 * The calendar table of dates
 */
.picker__table {
  text-align: center;
  border-collapse: collapse;
  border-spacing: 0;
  table-layout: fixed;
  font-size: inherit;
  width: 100%;
  margin-top: .75em;
  margin-bottom: .5em;
}
@media (min-height: 33.875em) {
  .picker__table {
    margin-bottom: .75em;
  }
}

/**
 * The weekday labels
 */
.picker__weekday {
  width: 14.285714286%;
  font-size: .75em;
  padding-bottom: .25em;
  color: <?php echo wc_hex_darker( $background_color, 100 ); ?>;
  font-weight: 500;
  text-align: center;
  /* Increase the spacing a tad */

}
@media (min-height: 33.875em) {
  .picker__weekday {
    padding-bottom: .5em;
  }
}
/**
 * The days on the calendar
 */
.picker__day {
  padding: .3125em 0;
  font-weight: 200;
  border: 1px solid transparent;
  text-align: center;
}
.picker__day--today {
  color: <?php echo wc_format_hex( $main_color ); ?>;
  position: relative;
}
.picker__day--today:before {
  content: " ";
  position: absolute;
  top: 2px;
  right: 2px;
  width: 0;
  height: 0;
  border-top: 0.5em solid <?php echo wc_hex_darker( $main_color, 50 ); ?>;
  border-left: .5em solid transparent;
}
.picker__day--disabled:before {
  border-top-color: <?php echo wc_hex_darker( $background_color, 75 ); ?>;
}
.picker__day--outfocus {
  color: <?php echo wc_hex_darker( $background_color, 25 ); ?>;
}
.picker__day--infocus:hover,
.picker__day--outfocus:hover {
  cursor: pointer;
  color: <?php echo wc_format_hex( $text_color ); ?>;
  background: <?php echo wc_hex_lighter( $main_color, 75 ); ?>;
}
.picker__day--highlighted {
  border-color: <?php echo wc_format_hex( $main_color ); ?>;
}
.picker__day--highlighted:hover,
.picker--focused .picker__day--highlighted {
  cursor: pointer;
  background: <?php echo wc_format_hex( $main_color ); ?>;
  color: <?php echo wc_format_hex( $background_color ); ?>;
}
.picker__day--selected,
.picker__day--selected:hover,
.picker--focused .picker__day--selected {
  background: <?php echo wc_format_hex( $main_color ); ?>;
  color: <?php echo wc_format_hex( $background_color ); ?>;
}
.picker__day--disabled,
.picker__day--disabled:hover,
.picker--focused .picker__day--disabled {
  background: <?php echo wc_hex_darker( $background_color, 10 ); ?>;
  border-color: <?php echo wc_hex_darker( $background_color, 10 ); ?>;
  color: <?php echo wc_hex_darker( $background_color, 25 ); ?>;
  cursor: default;
}
.picker__day--highlighted.picker__day--disabled,
.picker__day--highlighted.picker__day--disabled:hover {
  background: <?php echo wc_hex_darker( $background_color, 40 ); ?>;
}
/**
 * The footer containing the "today" and "clear" buttons.
 */
.picker__footer {
  text-align: center;
}
.picker__button--today,
.picker__button--clear,
.picker__button--close {
  border: 1px solid <?php echo wc_format_hex( $background_color ); ?>;
  background: <?php echo wc_format_hex( $background_color ); ?>;
  color: <?php echo wc_format_hex( $text_color ); ?>;
  font-size: .8em;
  padding: .66em 0;
  font-weight: bold;
  width: 33%;
  display: inline-block;
  vertical-align: bottom;
}
.picker__button--today:hover,
.picker__button--close:hover,
.picker__button--clear:hover {
  cursor: pointer;
  color: <?php echo wc_format_hex( $text_color ); ?>;
  background: <?php echo wc_hex_lighter( $main_color, 75 ); ?>;
  border-bottom-color: <?php echo wc_hex_lighter( $main_color, 75 ); ?>;
}
.picker__button--today:focus,
.picker__button--clear:focus,
.picker__button--close:focus {
  background: <?php echo wc_hex_lighter( $main_color, 75 ); ?>;
  border-color: <?php echo wc_format_hex( $main_color ); ?>;
  outline: none;
}
.picker__button--today:before,
.picker__button--clear:before,
.picker__button--close:before {
  position: relative;
  display: inline-block;
  height: 0;
}
.picker__button--today:before,
.picker__button--clear:before {
  content: " ";
  margin-right: .45em;
}
.picker__button--today:before {
  top: -0.05em;
  width: 0;
  border-top: 0.66em solid <?php echo wc_hex_darker( $main_color, 50 ); ?>;
  border-left: .66em solid transparent;
}
.picker__button--clear:before {
  top: -0.25em;
  width: .66em;
  border-top: 3px solid #ee2200;
}
.picker__button--close:before {
  content: "\D7";
  top: -0.1em;
  vertical-align: top;
  font-size: 1.1em;
  margin-right: .35em;
  color: <?php echo wc_hex_darker( $background_color, 150 ); ?>;
}
.picker__button--today[disabled],
.picker__button--today[disabled]:hover {
  background: <?php echo wc_hex_darker( $background_color, 10 ); ?>;
  border-color: <?php echo wc_hex_darker( $background_color, 10 ); ?>;
  color: <?php echo wc_hex_darker( $background_color, 25 ); ?>;
  cursor: default;
}
.picker__button--today[disabled]:before {
  border-top-color: <?php echo wc_hex_darker( $background_color, 75 ); ?>;
}
.picker__day--inrange {
  color: <?php echo wc_format_hex( $text_color ); ?>;
  background: <?php echo wc_format_hex( $main_color ); ?>;
  border-color: <?php echo wc_format_hex( $main_color ); ?>;
}
.picker__day--inrange.picker__day--disabled,
.picker__day--inrange.picker__day--disabled:hover {
  background: <?php echo wc_format_hex( $main_color ); ?>;
  border-color: <?php echo wc_format_hex( $main_color ); ?>;
}

/* ==========================================================================
   Availability
   ========================================================================== */

.picker__day.booked {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAPElEQVQYV2NkIADOnj37nxGfGpACY2NjRpyKYApAhmBVhKwAqyJ0BRiKsClAUYRLAVwRPgVgRYQUgBQBAKv8I3BUT3C3AAAAAElFTkSuQmCC) repeat;
}

.picker__day--stock {
  position: relative;
  padding: .3125em 50% .3125em 0;
}

.picker__day--status {
  position: relative;
}

.wceb-stock-status {
  box-sizing: border-box;
  height: 5px;
  width: 5px;
  border-radius: 50%;
  position: absolute;
  bottom: 2px;
  right: 2px;
}

.picker__day--background:not(.picker__day--selected):not(.picker__day--highlighted).in_stock:not(:hover) {
  background: #5fa644;
  border: 1px solid <?php echo wc_hex_darker($background_color, 10); ?>;
}

.picker__day--background:not(.picker__day--selected):not(.picker__day--highlighted).low:not(:hover) {
  background: #e49518;
  border: 1px solid <?php echo wc_hex_darker($background_color, 10); ?>;
}

.wceb-stock-status.in_stock {
  background: #5fa644;
}

.wceb-stock-status.low {
  background: #e49518;
}

.wceb-stock-amount {
  box-sizing: border-box;
  height: 100%;
  width: 50%;
  font-size: 0.8em;
  position: absolute;
  top: 0;
  right: 0;
  padding: .525em 0 .525em 0;
  background: <?php echo wc_hex_darker($background_color, 10); ?>;
  text-align: center;
}

.wceb-stock-amount.in_stock {
  color: #5fa644;
}

.wceb-stock-amount.low {
  color: #e49518;
}

@media (max-width: 480px) {
  .wceb-stock-amount, .wceb-stock-status {
    display: none;
  }
}

.picker__day--highlighted .wceb-stock-amount {
  color: <?php echo $text_color; ?>;
}