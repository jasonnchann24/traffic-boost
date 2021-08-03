module.exports = {
  projects: [
    {
      root: "./client", //root of subproject
      package: "./package.json", // It is relative to root property.
      tsconfig: "./jsconfig.json", // It is relative to root property.
    },
  ],
};
