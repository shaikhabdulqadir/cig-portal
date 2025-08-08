import moment from "moment";

export default {
    computed: {
        isAdvanceMode() {
            return this.$page.props.auth.user.simple_mode == 0;
        },
        isSimpleMode() {
            return this.$page.props.auth.user.simple_mode == 1;
        },
    },
    methods: {
        __(key, replace = {}) {
            var translation = this.$page.props.language[key]
                ? this.$page.props.language[key]
                : key;
            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(":" + key, replace[key]);
            });
            return translation;
        },
        dateTime(value, format = "DD-MM-YYYY HH:mm") {
            return moment(value).format(format);
        },
        date(value) {
            return moment(value).format("DD-MM-YYYY");
        },
        capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        currencyFormat(number) {
            let formatted = number.toLocaleString("nl-NL", {
                currency: "EUR",
                style: "currency",
            });

            return formatted.replace(",00", "");
        },
        allowOneCh($event) {
            if ($event.target.value.length >= 1 && $event.code != "Backspace") {
                $event.preventDefault();
            }
        },
        sort(sort_by) {
            const urlParams = new URLSearchParams(window.location.search);
            let sort_order = urlParams.get("sort_order");
            let sort_by_old = urlParams.get("sort_by");
            sort_order =
                sort_order == "asc" && sort_by_old == sort_by ? "desc" : "asc";
            this.$inertia.get(
                `${location.pathname}`,
                { sort_by: sort_by, sort_order: sort_order },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        },
    },
};
