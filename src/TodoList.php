<?php

class TodoList
{
    public $tasks;
    
    public function addTask(Task $task)
    {
        $this->tasks->add($task);
    }
    
    function it_checks_whether_it_has_any_tasks(TaskCollection $tasks)
    {
        $tasks->count()->willReturn(0);
        $this->tasks = $tasks;

        $this->hasTasks()->shouldReturn(false);
        
        $tasks->count()->willReturn(20);
        $this->tasks = $tasks;

        $this->hasTasks()->shouldReturn(true);
    }

    public function hasTasks()
    {
        return false;
    }
}
