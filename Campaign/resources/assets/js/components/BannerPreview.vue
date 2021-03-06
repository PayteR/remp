<style type="text/css">
    @import '../../sass/banner.scss';
</style>

<template>
    <div class="remp-banner">
        <html-preview v-if="template === 'html'"
                :alignmentOptions="alignmentOptions"
                :dimensionOptions="dimensionOptions"
                :positionOptions="positionOptions"
                :show="visible"
                :uuid="uuid"
                :campaignUuid="campaignUuid"
                :forcedPosition="forcedPosition"

                :textAlign="htmlTemplate.textAlign"
                :dimensions="htmlTemplate.dimensions"
                :textColor="htmlTemplate.textColor"
                :fontSize="htmlTemplate.fontSize"
                :backgroundColor="htmlTemplate.backgroundColor"
                :text="htmlTemplate.text"
                :css="htmlTemplate.css"

                :position="position"
                :offsetVertical="offsetVertical"
                :offsetHorizontal="offsetHorizontal"
                :targetUrl="targetUrl"
                :closeable="closeable"
                :closeText="closeText"
                :transition="transition"
                :displayType="displayType"
        ></html-preview>

        <medium-rectangle-preview v-if="template === 'medium_rectangle'"
                :alignmentOptions="alignmentOptions"
                :positionOptions="positionOptions"
                :show="visible"
                :uuid="uuid"
                :campaignUuid="campaignUuid"
                :forcedPosition="forcedPosition"

                :headerText="mediumRectangleTemplate.headerText"
                :mainText="mediumRectangleTemplate.mainText"
                :buttonText="mediumRectangleTemplate.buttonText"
                :width="mediumRectangleTemplate.width"
                :height="mediumRectangleTemplate.height"
                :backgroundColor="mediumRectangleTemplate.backgroundColor"
                :textColor="mediumRectangleTemplate.textColor"
                :buttonBackgroundColor="mediumRectangleTemplate.buttonBackgroundColor"
                :buttonTextColor="mediumRectangleTemplate.buttonTextColor"

                :position="position"
                :offsetVertical="offsetVertical"
                :offsetHorizontal="offsetHorizontal"
                :targetUrl="targetUrl"
                :closeable="closeable"
                :closeText="closeText"
                :transition="transition"
                :displayType="displayType"
        ></medium-rectangle-preview>

        <bar-preview v-if="template === 'bar'"
                :alignmentOptions="alignmentOptions"
                :positionOptions="positionOptions"
                :show="visible"
                :uuid="uuid"
                :campaignUuid="campaignUuid"
                :forcedPosition="forcedPosition"

                :mainText="barTemplate.mainText"
                :buttonText="barTemplate.buttonText"
                :backgroundColor="barTemplate.backgroundColor"
                :textColor="barTemplate.textColor"
                :buttonBackgroundColor="barTemplate.buttonBackgroundColor"
                :buttonTextColor="barTemplate.buttonTextColor"

                :position="position"
                :offsetVertical="offsetVertical"
                :offsetHorizontal="offsetHorizontal"
                :targetUrl="targetUrl"
                :closeable="closeable"
                :closeText="closeText"
                :transition="transition"
                :displayType="displayType"
        ></bar-preview>

        <collapsible-bar-preview v-if="template === 'collapsible_bar'"
                :alignmentOptions="alignmentOptions"
                :positionOptions="positionOptions"
                :show="visible"
                :uuid="uuid"
                :campaignUuid="campaignUuid"
                :forcedPosition="forcedPosition"

                :mainText="collapsibleBarTemplate.mainText"
                :headerText="collapsibleBarTemplate.headerText"
                :collapseText="collapsibleBarTemplate.collapseText"
                :expandText="collapsibleBarTemplate.expandText"
                :buttonText="collapsibleBarTemplate.buttonText"
                :backgroundColor="collapsibleBarTemplate.backgroundColor"
                :textColor="collapsibleBarTemplate.textColor"
                :buttonBackgroundColor="collapsibleBarTemplate.buttonBackgroundColor"
                :buttonTextColor="collapsibleBarTemplate.buttonTextColor"
                :initialState="collapsibleBarTemplate.initialState"

                :targetUrl="targetUrl"
                :transition="transition"
                :displayType="displayType"
        ></collapsible-bar-preview>

        <short-message-preview v-if="template === 'short_message'"
                :alignmentOptions="alignmentOptions"
                :positionOptions="positionOptions"
                :show="visible"
                :uuid="uuid"
                :campaignUuid="campaignUuid"
                :forcedPosition="forcedPosition"

                :text="shortMessageTemplate.text"
                :backgroundColor="shortMessageTemplate.backgroundColor"
                :textColor="shortMessageTemplate.textColor"

                :position="position"
                :offsetVertical="offsetVertical"
                :offsetHorizontal="offsetHorizontal"
                :targetUrl="targetUrl"
                :closeable="closeable"
                :closeText="closeText"
                :transition="transition"
                :displayType="displayType"
        ></short-message-preview>

        <overlay-rectangle-preview v-if="template === 'overlay_rectangle'"
                :alignmentOptions="alignmentOptions"
                :show="visible"
                :uuid="uuid"
                :campaignUuid="campaignUuid"

                :headerText="overlayRectangleTemplate.headerText"
                :mainText="overlayRectangleTemplate.mainText"
                :buttonText="overlayRectangleTemplate.buttonText"
                :width="overlayRectangleTemplate.width"
                :height="overlayRectangleTemplate.height"
                :backgroundColor="overlayRectangleTemplate.backgroundColor"
                :textColor="overlayRectangleTemplate.textColor"
                :buttonBackgroundColor="overlayRectangleTemplate.buttonBackgroundColor"
                :buttonTextColor="overlayRectangleTemplate.buttonTextColor"
                :imageLink="overlayRectangleTemplate.imageLink"

                :targetUrl="targetUrl"
                :closeable="closeable"
                :closeText="closeText"
                :transition="transition"
                :displayType="displayType"
                :adminPreview="adminPreview"
        >
        </overlay-rectangle-preview>
    </div>
</template>


<script>
    import HtmlPreview from "./previews/Html";
    import MediumRectanglePreview from "./previews/MediumRectangle";
    import BarPreview from "./previews/Bar";
    import CollapsibleBarPreview from "./previews/CollapsibleBar";
    import ShortMessagePreview from "./previews/ShortMessage";
    import OverlayRectanglePreview from "./previews/OverlayRectangle";

    const props = [
        "name",
        "targetUrl",
        "position",
        "offsetVertical",
        "offsetHorizontal",
        "transition",
        "closeable",
        "closeText",
        "displayDelay",
        "closeTimeout",
        "targetSelector",
        "displayType",
        "template",
        "uuid",
        "campaignUuid",
        "forcedPosition",
        "show",

        "variables",

        "mediumRectangleTemplate",
        "barTemplate",
        "collapsibleBarTemplate",
        "htmlTemplate",
        "shortMessageTemplate",
        "overlayRectangleTemplate",

        "alignmentOptions",
        "dimensionOptions",
        "positionOptions",

        "variantUuid",

        "adminPreview"
    ];

    export default {
        components: {
            HtmlPreview,
            MediumRectanglePreview,
            BarPreview,
            CollapsibleBarPreview,
            ShortMessagePreview,
            OverlayRectanglePreview,
        },
        name: 'banner-preview',
        props: props,
        created: function() {
            this.$on('values-changed', function(data) {
                for (let item of data) {
                    this[item.key] = item.val;
                }
            });
        },
        mounted: function() {
            props.forEach((prop) => {
                this[prop.slice(1)] = this[prop];
            });

            this.visible = this.show;
        },
        data: () => ({
            visible: false,
        }),
        watch: {
            'transition': function() {
                let vm = this;
                setTimeout(function() { vm.visible = false }, 100);
                setTimeout(function() { vm.visible = true }, 800);
            },
            'show': function() {
            	this.visible = this.show;
            }
        },
        computed: {
            url: function() {
                if (!this.targetUrl) {
                    return null;
                }
                let separator = this.targetUrl.indexOf("?") === -1 ? "?" : "&";
                let url =  this.targetUrl + separator + "utm_source=remp_campaign" +
                    "&utm_medium=" + encodeURIComponent(this.displayType);
                if (this.campaignUuid) {
                    url += "&utm_campaign=" + encodeURIComponent(this.campaignUuid);
                }
                if (this.uuid) {
                    url += "&utm_content=" + encodeURIComponent(this.uuid);
                }
                if (this.variantUuid) {
                    url += "&banner_variant=" + encodeURIComponent(this.variantUuid);
                }
                return url;
            },
        },
        methods: {
            injectVars: function(str) {
                if (!remplib || !remplib.campaign) {
                    return str;
                }
                let re = /\{\{\s?(.*?)\s?\}\}/g;
                let match;

                while (match = re.exec(str)) {
                    let replRegex = new RegExp(match[0], "g");
                    let replVal = '';
                    if (remplib.campaign.variables && remplib.campaign.variables.hasOwnProperty(match[1])) {
                        replVal = remplib.campaign.variables[match[1]].value()
                    } else {
                        throw EvalError("cannot render banner, variable [" + match[1] + "] is missing");
                    }
                    str = str.replace(replRegex, replVal);
                }
                return str;
            },
            closed: function() {
				this.visible = false;
				this.$parent.$emit('values-changed', [
                    {key: "show", val: false}
                ]);
                if (this.closeTracked) {
                    return true;
                }
                this.trackEvent("banner", "close", null, null, {
                    "utm_source": "remp_campaign",
                    "utm_medium": this.displayType,
                    "utm_campaign": this.campaignUuid,
                    "utm_content": this.uuid,
                    "banner_variant": this.variantUuid
                });
                this.closeTracked = true;
            },
            clicked: function(event, hideBanner = false) {
                if (this.clickTracked) {
                    return true;
                }
                this.trackEvent("banner", "click", null, null, {
                    "utm_source": "remp_campaign",
                    "utm_medium": this.displayType,
                    "utm_campaign": this.campaignUuid,
                    "utm_content": this.uuid,
                    "banner_variant": this.variantUuid
                });
                this.clickTracked = true;
                if (hideBanner) {
                    this.visible = false;
                }
                return true;
            },
            trackEvent: function(category, action, tags, fields, source) {
                if (typeof remplib.tracker === 'undefined') {
                    return;
                }
                remplib.tracker.trackEvent(category, action, tags, fields, source);
            },
            customPositioned: function() {
                if (this.displayType === 'inline') {
                    return false;
                }
                if (this.displayType === 'overlay') {
                    return true;
                }
                if (this.forcedPosition !== undefined && this.forcedPosition === 'absolute') {
                    return true;
                }
                return false;
            },
        }
    }
</script>
