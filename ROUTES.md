+----------+-----------------------------+-------------------------------------------------------------------------------+-------------------------------+
| Method   | URI                         | Action                                                                        | Body                          |
+----------+-----------------------------+-------------------------------------------------------------------------------+-------------------------------+
| POST     | api/account/register        | Register new user                                                             | {"email", "password", "name"} |
| POST     | api/account/login           | Log in, get auth cookies                                                      | {"email", "password"}         |
| GET|HEAD | api/developers              | Fetch all users                                                               |                               |
| GET|HEAD | api/developers/{user}       | Fetch given user                                                              |                               |
| GET|HEAD | api/developers/{user}/tasks | Fetch given user's tasks                                                      |                               |
| GET|HEAD | api/tasks                   | Fetch all tasks                                                               |                               |
| GET|HEAD | api/tasks/{task}            | Fetch given task                                                              |                               |
| GET|HEAD | api/tasks/{task}/assignee   | Fetch given task's assignee                                                   |                               |
| POST     | api/tasks/{task}/assignee   | Assign given task to user                                                     | {"user_id"}                   |
| GET|HEAD | api/user                    | (Protected: Must authenticate) Fetch logged in user                           |                               |
| GET|HEAD | api/user/tasks              | (Protected: Must autehnticate) Fetch logged in user's tasks                   |                               |
| POST     | api/user/tasks/resolve      | (Protected: Must own task) Mark given task as done                            | {"task_id"}                   |
| POST     | api/user/tasks/trade        | (Protected: Must own task) Reassign from given task to target unassigned task | {"my_task_id", "new_task_id"} |
| GET|HEAD | sanctum/csrf-cookie         | Get XSRF token cookie                                                         |                               |
+----------+-----------------------------+-------------------------------------------------------------------------------+-------------------------------+