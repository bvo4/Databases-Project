# Formatting/Naming convention

## A note on file structure
### Containers
These will be the pages of the website. You should create a directory in /containters/ named after the title of the page. Design the page using styled-components to handle styling (CSS) as shown below. Once the page is finished, you need to add the page to the routes array in /constants/Routes.js to allow the page to be accessed through the URL or links in other pages. 
### Components
Components are reusable pieces that we will need to be used multiple times throughout pages and the overall site. These will be contained in a folder such as Button, NavBar, or Link and have an index.js file within those folders. Use the convention below for building components. As opposed to using a React class, we will build them as constants. This creates cleaner code and will give us a consistent feel across components. If state is needed in the component use [Hooks](https://reactjs.org/docs/hooks-intro.html). 
### Documentation
Make sure to add proper documentation to all files. If it becomes an issue, we can add tools like prop-types and defaultProps to allow for some extra documentation.


### Naming:
##### variables/functions: 
  camelCase
* if component: 
  UpperCase
##### folders: 
  lower_case 
* if component: 
  UpperCase
##### branches: 
  kebab-case

### Formatting:
##### React Component:
```
const CompName = (parameters) => {                   // component names and props/parameters to be used
  const [var, func] = React.useState(initialState);  // declare state using hooks if necessary, var will be set to initialState and can be updated with func
  const otherFunction(input){                        // declare other necessary functions for component
    // code to do something
   };
   return (                                          // start JSX syntax, this is basically HTML using JavaScript; return will render the component
    <div>
      <p>Hello, World!</p>
    </div>
   )
}
```
##### Styling:
As opposed to CSS, we will use the styled-components library to include CSS directly into our JavaScript files
```
const Container = styled.div`                       // can use this syntax to restyle HTML elements, then can call <Container/> in React components
  color: black;                                     // these are normal CSS properties and follow CSS syntax
  width: 100%;
  height: 100vh;
`
```
