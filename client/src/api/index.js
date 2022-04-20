// Example API call
export const fetchData = async () => {
  try {
    const res = await fetch("http://127.0.0.1:8000/api/");
    const data = await res.json();
    console.log(data);
  } catch (e) {
    console.log(e);
  }
};

// Example class will API call and use of data
// import React from "react";

// const Todo = () => {
//   const [todos, setTodos] = React.useState([]);

//   React.useEffect(() => {
//     const fetchData = async () => {
//       try {
//         const res = await fetch("http://127.0.0.1:8000/todos/");
//         const todos = await res.json();
//         setTodos(todos);
//       } catch (e) {
//         console.log(e);
//       }
//     };
//     fetchData();
//   }, []);

//   let Todos = () => {
//     return (
//       <div>
//         {todos.map(item => (
//           <div key={item.id}>
//             <h1>{item.title}</h1>
//             <span>{item.description}</span>
//           </div>
//         ))}
//       </div>
//     );
//   };

//   return <Todos></Todos>;
// };

// export default Todo;
