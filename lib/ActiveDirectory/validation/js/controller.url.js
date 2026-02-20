/*!
 * url Javascipt Bonz.
 * Version 2024-01-16
 */

const controller_url = (() => {
  const config = {
    env: "PROD",
    url_show_default: "404",
    url_show_lang: false,
    language: "th",
    lang_set: {
      th: ["", "Thai", "th", "", "Thai"],
      en: ["", "English", "en", "en", "Eng"],
    },
  };

  let prop = {};

  prop.init = () => {
    let base_url;
    let obj;
    let lang_slug = "";
    let onFolder = "";
    let parametter = "";
    let slug = location.pathname?.split("/")?.filter((item) => item);
    let location_origin = location.origin;

    if (config.env == "DEV") {
      // show lang
      if (config.url_show_lang) {
        if (config.lang_set?.[slug[1]] === undefined) {
          lang_slug = "/" + config.lang_set?.[config.language][2];
        } else {
          lang_slug = "/" + slug[1];
        }

        slug = jQuery.grep(slug, function (value) {
          return value != slug[0];
        });
      } else {
        lang_slug = config.language;
      }
      onFolder = slug[0];
      base_url =
        location_origin +
        "/" +
        slug[0] +
        (config.url_show_lang ? lang_slug : "");

      slug = jQuery.grep(slug, function (value) {
        return value != slug[0];
      });
    } else {
      // show lang
      if (config.url_show_lang) {
        if (config.lang_set?.[slug[0]] === undefined) {
          lang_slug = "/" + config.lang_set?.[config.language][2];
        } else {
          lang_slug = "/" + slug[0];
        }
        slug = jQuery.grep(slug, function (value) {
          return value != slug[0];
        });
      } else {
        lang_slug = config.language;
      }
      base_url = location_origin + (config.url_show_lang ? lang_slug : "");
    }

    // parametter
    let search = location.search?.split("?");
    parametter = search[1];

    obj = {
      url: base_url,
      slug: slug,
      pagelang:
        config.lang_set?.[lang_slug.replace("/", "")] ?? config.language,
      onFolder: onFolder,
      parametter: parametter,
    };
    return obj;
  };
  return prop;
})();
