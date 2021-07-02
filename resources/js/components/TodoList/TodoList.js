import React from 'react';
import './TodoList.css';
import Todo from './Todo/Todo';

const TodoList = (props) => {

  let todos = props.todos.map((todo, index) => {
      return <Todo title={todo.title.charAt(0).toUpperCase() + todo.title.slice(1)} id={todo.id} done={todo.done} key={index} clicked={props.marker} deleteTodo={props.delete} />
  });
  
  return (
    <div className="todoListContainer">
      {props.todos ? todos : <div className="noTodo"><p>No todos yet.</p></div>}
    </div>
  );
}
export default TodoList;