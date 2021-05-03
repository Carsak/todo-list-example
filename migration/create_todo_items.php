<?php

return 'CREATE TABLE IF NOT EXISTS "todo_items" (
"id"	INTEGER,
"email"	TEXT NOT NULL,
"username"	TEXT NOT NULL,
"description"	TEXT NOT NULL,
"isEdited"	INTEGER DEFAULT 0,
"isDone"	INTEGER DEFAULT 0,
PRIMARY KEY("id" AUTOINCREMENT)
)';