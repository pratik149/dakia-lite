import axios from "axios";

export default {
  install: (app, options) => {
    app.config.globalProperties.$axios = axios.create({
      baseURL: options.baseUrl,
      headers: {
        "Content-type": "application/json",
      },
    });
  },
};
