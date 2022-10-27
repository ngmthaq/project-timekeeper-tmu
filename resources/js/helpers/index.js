import localStorage from "../configs/localStorage";

const localeKey = localStorage.key.locale;

export function getLocale() {
    let locale = window.locales.includes(window.appLocale)
        ? window.appLocale
        : window.fallbackLocale;

    return window.localStorage.getItem(localeKey) || locale;
}

export function getLocales() {
    return window.locales;
}

export function $t(key, replace = {}) {
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
}

export function $tc(key, count = 1, replace = {}) {
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
}
