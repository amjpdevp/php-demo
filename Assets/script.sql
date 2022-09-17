CREATE TABLE users (
    user_id INT AUTO_INCREMENT,
    name VARCHAR(255),
    passwords VARCHAR(255),
    is_Admin INT,
    Created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id)
);
CREATE TABLE entities (
    entity_id INT NOT NULL AUTO_INCREMENT,
    entity_name VARCHAR(255),
    email VARCHAR(255),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (entity_id),
    user_id INT,
    FOREIGN KEY (user_id)
        REFERENCES users (user_id));
CREATE TABLE employees (
    employee_id INT AUTO_INCREMENT,
    entity_id INT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    passwords VARCHAR(255),
    gender VARCHAR(255),
    DOB DATE,
    permissions VARCHAR(300),
    picture VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL,
    PRIMARY KEY (employee_id),
    FOREIGN KEY (entity_id)
        REFERENCES entities (entity_id));
CREATE TABLE departments (
    department_id INT NOT NULL AUTO_INCREMENT,
    department_name VARCHAR(255),
    entity_id INT,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (department_id),
    FOREIGN KEY (entity_id)
        REFERENCES entities (entity_id));
CREATE TABLE salaries (
    salary_id INT NOT NULL AUTO_INCREMENT,
    amount INT,
    employee_id INT,
    department_id INT,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (salary_id),
    FOREIGN KEY (employee_id)
        REFERENCES employees (employee_id),
    FOREIGN KEY (department_id)
        REFERENCES departments (department_id));
create table tasks (
	task_id int not null,
    dates date,
    employee_id int,
    entity_id int,a
    department_id int,
    task_image varchar(255),
    task_description varchar(255),
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key (task_id),
    foreign key (employee_id)
	references employees (employee_id),
	foreign key (entity_id)
	references entities (entity_id),
	foreign key (department_id)
	references departments (department_id));