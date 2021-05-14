---
title: Color System
status: draft
---

[View the colors in action](/components/detail/colors) 

## Color variables

**$color-01** - **$color-12**

$color-##-dark  = darken($color-##, 20%);

$color-##-light = lighten($color-##, 20%);

## Driessen Groep Color-variablename conventions
---
The colors below should always be set to one of the 12 colors of the colorsystem.

**$color-borders**
>This is the border-color for form-fields, table-cells. 

**$color-accept**
> This is the color that should be applied to all 'Accept' or 'Ok' elements such as submitbuttons etc. 

**$color-deny**
> This is the color that should be applied to all 'Denied', 'Cancel' or 'Reject' buttons such as clear form etc.

**$color-text-body**
> This is the basic textcolor which will be set to the body.

**$color-text-headers**
> This is the textcolor that will be applied to h1 - h6.

**$color-text-link**
> This is the textcolor for all basic link-elements such as 'a'.

**$color-bg**
> Basic background color for elements (table headings, CTA).

**$color-bg-light**
> Light variant of the above color for alternating tables etc.

## Bootstrap link to Drigro colors
---
**Bootstrap basic color will be tied to Drigro colors as follows:**

**$primary:** $color-01;

**$secondary:** $color-02;

**$succes:** $color-accept;

**$danger:** $color-deny;

**$warning:** lighten($color-deny, 20%);

**$info:** $color-accept;

**$dark:** darken($color-text, 20%);

**$muted:** lighten($color-text, 20%);

**$white:** #ffffff;

**$table-border-color:** $color-borders;

**$tabs-divider-color:** $color-borders;
