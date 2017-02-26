class Locale{

  constructor(locale){

    this.locale = require(`json-loader!../locales/${locale}.json`);
  }

  get(key , p = ''){

    return this.locale[key].replace('%s' , p);
  }
}


window.Locale = new Locale(window.appLocal);
