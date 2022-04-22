import React from "react";
import { routes } from "../../constants/Routes";
import LinkComp from "./index";

const Links = () => {
  return (
    <ul>
      {routes.map(route => (
        <li key={route.name}>
          <LinkComp to={route.path}>{route.name}</LinkComp>
        </li>
      ))}
    </ul>
  );
};
export default Links;
