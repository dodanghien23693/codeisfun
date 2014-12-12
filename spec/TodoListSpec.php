<?php

namespace spec;
use TaskCollection;
use Task;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TodoListSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('TodoList');
    }
    
    function it_adds_a_task_to_the_list(TaskCollection $tasks, Task $task)
    {
        $tasks->add($task)->shouldBeCalledTimes(1);
        $this->tasks = $tasks;
 
        $this->addTask($task);
    }
    
    function it_checks_whether_it_has_any_tasks(TaskCollection $tasks)
    {
        $tasks->count()->willReturn(0);
        $this->tasks = $tasks;

        $this->hasTasks()->shouldReturn(false);
    }
}
