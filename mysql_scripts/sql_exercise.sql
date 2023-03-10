-- SET FOREIGN_KEY_CHECKS = 0;
-- drop table if exists GRADE_REPORT;
-- drop table if exists PREREQUISITE;
-- drop table if exists SECTION;
-- drop table if exists COURSE;
-- drop table if exists STUDENT;
-- SET FOREIGN_KEY_CHECKS = 1;
-- CREATE TABLE STUDENT (
--     student_name varchar(32) NOT NULL,
--     student_number int NOT NULL,
--     student_class varchar(32) NOT NULL,
--     student_major varchar(32) NOT NULL,
--     PRIMARY KEY (student_number)
-- );
-- CREATE TABLE COURSE (
--     course_name varchar(32) NOT NULL,
--     course_number varchar(32) NOT NULL,
--     credit_hours int(1) NOT NULL,
--     department varchar(32) NOT NULL,
--     PRIMARY KEY (course_number)
-- );
-- CREATE TABLE SECTION (
--     section_identifier int NOT NULL,
--     course_number varchar(32) NOT NULL,
--     semester varchar(32) NOT NULL,
--     section_year int NOT NULL,
--     instructor varchar(32) NOT NULL,
--     PRIMARY KEY (section_identifier),
--     FOREIGN KEY (course_number) REFERENCES COURSE(course_number)
-- );
-- CREATE TABLE GRADE_REPORT (
--     student_number int NOT NULL,
--     section_identifier int NOT NULL,
--     grade varchar(32) NOT NULL,
--     PRIMARY KEY (student_number, section_identifier),
--     FOREIGN KEY (student_number) REFERENCES STUDENT(student_number),
--     FOREIGN KEY (section_identifier) REFERENCES SECTION(section_identifier)
-- );
-- CREATE TABLE PREREQUISITE (
--     course_number varchar(32) NOT NULL,
--     prerequisite_number varchar(32) NOT NULL,
--     PRIMARY KEY (course_number, prerequisite_number),
--     FOREIGN KEY (course_number) REFERENCES COURSE(course_number),
--     FOREIGN KEY (prerequisite_number) REFERENCES COURSE(course_number)
-- );
-- INSERT INTO STUDENT(
--         student_name,
--         student_number,
--         student_class,
--         student_major
--     )
-- VALUES ('Smith', 17, 1, 'CS'),
--     ('Brown', 8, 2, 'CS');
-- INSERT INTO COURSE(
--         course_name,
--         course_number,
--         credit_hours,
--         department
--     )
-- VALUES ('Intro to Computer Science', 'CS1310', 4, 'CS'),
--     ('Data Structures', 'CS3320', 4, 'CS'),
--     ('Discrete Mathematics', 'MATH2410', 3, 'MATH'),
--     ('Database', 'CS3380', 3, 'CS');
-- INSERT INTO SECTION(
--         section_identifier,
--         course_number,
--         semester,
--         section_year,
--         instructor
--     )
-- VALUES (85, 'MATH2410', 'Fall', 98, 'King'),
--     (92, 'CS1310', 'Fall', 98, 'Anderson'),
--     (102, 'CS3320', 'Fall', 99, 'Knuth'),
--     (112, 'MATH2410', 'Fall', 99, 'Chang'),
--     (119, 'CS1310', 'Fall', 99, 'Anderson'),
--     (135, 'CS3380', 'Fall', 99, 'Stone');
-- INSERT INTO GRADE_REPORT(
--         student_number,
--         section_identifier,
--         grade
--     )
-- VALUES (17, 112, 'B'),
--     (17, 119, 'C'),
--     (8, 85, 'A'),
--     (8, 92, 'A'),
--     (8, 102, 'B'),
--     (8, 135, 'A');
-- INSERT INTO PREREQUISITE(
--         course_number,
--         prerequisite_number
--     )
-- VALUES ('CS3380', 'CS3320'),
--     ('CS3380', 'MATH2410'),
--     ('CS3320', 'CS1310');
-- the following sql commands will cause integrity constraint violations
-- -- INSERT INTO GRADE_REPORT VALUES (9, 135, 'A');
-- -- DELETE FROM STUDENT WHERE student_number=17; -- this fails since ON DELETE CASCADE is not specified
-- --  INSERT INTO STUDENT VALUES ('Bova', 99999999999999999999, 1, 'CS'); -- this fails since student_number is an int and not a bigint
-- INSERT INTO COURSE VALUES ('Intro to Computer Science', 'CS1310', 4, 'CS'); -- this fails since course_number is a primary key and cannot be duplicated