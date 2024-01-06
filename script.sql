create table if not exists roles
(
    id          int unsigned auto_increment comment 'id роли'
        primary key,
    name        varchar(255) null comment 'название роли',
    description varchar(255) null comment 'описание роли',
    constraint idxunic_roles_name
        unique (name)
)
    row_format = DYNAMIC;

create table if not exists users
(
    id                 int unsigned auto_increment comment 'id пользователя'
        primary key,
    name               varchar(255)                               not null comment 'имя пользователя',
    email              varchar(50)                                not null comment 'почта пользователя',
    email_verification tinyint unsigned default '0'               not null comment 'адрес проверен?',
    login              varchar(50)                                not null comment 'логин пользователя',
    password           varchar(255)                               not null comment 'пароль пользователя',
    is_admin           tinyint unsigned default '0'               not null comment 'это админ?',
    is_active          tinyint unsigned default '0'               not null comment 'учетная запись активна?',
    role               int unsigned     default '0'               not null comment 'id роли',
    last_login         timestamp                                  null comment 'время входа в учетную запись',
    created_at         timestamp        default CURRENT_TIMESTAMP null comment 'дата создания учетной записи',
    constraint idxunic_users_login
        unique (login),
    constraint users_ibfk_1
        foreign key (role) references roles (id)
)
    row_format = DYNAMIC;

create index role
    on users (role);


