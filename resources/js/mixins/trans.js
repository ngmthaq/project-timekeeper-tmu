import { getLocale, getLocales } from "../helpers";

const locales = getLocales();

export default {
    data() {
        return {
            $locales: locales,
        };
    },
    methods: {
        $t(key, replace = {}) {
            let locale = getLocale();
            let translation = key
                .split(".")
                .reduce((t, i) => t[i] || key, window.translations[locale]);

            if (translation == key) {
                translation = window.translationJsons[locale][key] || key;
            }

            for (var placeholder in replace) {
                translation = translation.replace(
                    `:${placeholder}`,
                    replace[placeholder]
                );
            }

            return translation;
        },

        $tc(key, count = 1, replace = {}) {
            let locale = getLocale();
            let translation = key
                .split(".")
                .reduce((t, i) => t[i] || key, window.translations[locale])
                .split("|");

            translation = count > 1 ? translation[1] : translation[0];

            for (var placeholder in replace) {
                translation = translation.replace(
                    `:${placeholder}`,
                    replace[placeholder]
                );
            }

            return translation;
        },

        $changeLocale(locale) {
            let currentLocale = getLocale();
            if (locale !== currentLocale) {
                this.$store.dispatch("locale/setLocale", { locale: locale });
                this.$bus.$emit("changeLocale", locale);
            }
        },
    },
};
