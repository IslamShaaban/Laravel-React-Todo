import React from 'react';
import './Todo.css';

const Todo = (props) => {
  return(
    <div className={props.done ? 'todo done' : 'todo'} id={props.id} title={props.done ? null : 'Click to mark as done.'}> 
      <div className="todo-container col-6" onClick={(event) => props.clicked(event)} id={props.id}>
        <i className="glyphicon glyphicon-ok check-mark"></i>
          <p>{props.title}</p>
      </div>
      <div className="close-btn-container" title="Click to Delete" id={props.id} onClick={(event) => props.deleteTodo(event)} >
        <i className="glyphicon glyphicon-remove remove-mark"></i>
      </div>
    </div>
  ); 
}
export default Todo;