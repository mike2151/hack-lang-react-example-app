<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

/**
 * This is the base library of HTML elements for use in XHP. This includes all
 * non-deprecated tags and attributes. Elements in this file should stay as
 * close to spec as possible. Facebook-specific extensions should go into their
 * own elements.
 */
abstract class :xhp:html-element extends :x:primitive {
  use XHPBaseHTMLHelpers;

  // enum { 'true', 'false' } attributes: these are actually tri-state -
  // the implied third value is usually 'auto' or 'inherit'; for example,
  // contenteditable defaults to 'inherit' if unspecified, so
  // contenteditable=false is valid ans has meaning

  attribute
    // Global HTML attributes
    string accesskey,
    string class,
    enum {'true', 'false'} contenteditable,
    string contextmenu,
    string dir,
    enum {'true', 'false'} draggable,
    string dropzone,
    bool hidden,
    string id,
    bool inert,
    string itemid,
    string itemprop,
    string itemref,
    string itemscope,
    string itemtype,
    string lang,
    string role,
    enum {'true', 'false'} spellcheck,
    string style,
    string tabindex,
    string title,
    enum {'yes', 'no'} translate,

    // Javascript events
    string onabort,
    string onblur,
    string oncancel,
    string oncanplay,
    string oncanplaythrough,
    string onchange,
    string onclick,
    string onclose,
    string oncontextmenu,
    string oncuechange,
    string ondblclick,
    string ondrag,
    string ondragend,
    string ondragenter,
    string ondragexit,
    string ondragleave,
    string ondragover,
    string ondragstart,
    string ondrop,
    string ondurationchange,
    string onemptied,
    string onended,
    string onerror,
    string onfocus,
    string oninput,
    string oninvalid,
    string onkeydown,
    string onkeypress,
    string onkeyup,
    string onload,
    string onloadeddata,
    string onloadedmetadata,
    string onloadstart,
    string onmousedown,
    string onmouseenter,
    string onmouseleave,
    string onmousemove,
    string onmouseout,
    string onmouseover,
    string onmouseup,
    string onmousewheel,
    string onpause,
    string onplay,
    string onplaying,
    string onprogress,
    string onratechange,
    string onreset,
    string onresize,
    string onscroll,
    string onseeked,
    string onseeking,
    string onselect,
    string onshow,
    string onstalled,
    string onsubmit,
    string onsuspend,
    string ontimeupdate,
    string ontoggle,
    string onvolumechange,
    string onwaiting;

  protected string $tagName = '';

  protected final function renderBaseAttrs(): string {
    $buf = '<'.$this->tagName;
    foreach ($this->getAttributes() as $key => $val) {
      if ($val !== null && $val !== false) {
        if ($val === true) {
          $buf .= ' '.htmlspecialchars($key);
        } else {
          if ($val is XHPUnsafeAttributeValue) {
            $val_str = $val->toHTMLString();
          } else {
            $val_str = htmlspecialchars((string) $val, ENT_COMPAT);
          }

          $buf .= ' '.
            htmlspecialchars($key).
            '="'.
            $val_str.
            '"';
        }
      }
    }
    return $buf;
  }

  protected function stringify(): string {
    $buf = $this->renderBaseAttrs().'>';
    foreach ($this->getChildren() as $child) {
      $buf .= :xhp::renderChild($child);
    }
    $buf .= '</'.$this->tagName.'>';
    return $buf;
  }
}
