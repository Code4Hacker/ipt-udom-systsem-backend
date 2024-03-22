DROP DATABASE IPTSYSTEM;

CREATE DATABASE IPTSYSTEM;

USE IPTSYSTEM;

CREATE TABLE
    STUDENTS (
        stdId INT PRIMARY KEY AUTO_INCREMENT,
        f_name VARCHAR(50),
        m_name VARCHAR(50),
        l_name VARCHAR(50),
        t_number VARCHAR(20) UNIQUE,
        mobile VARCHAR(14),
        e_mail VARCHAR(255),
        password VARCHAR(50) DEFAULT l_name,
        gender VARCHAR(2)
    );

CREATE TABLE
    ACADEMICINFOS (
        acId INT PRIMARY KEY AUTO_INCREMENT,
        collegeAbbr VARCHAR(20),
        collegeLong VARCHAR(100),
        departmentAbbr VARCHAR(20),
        departmentLong VARCHAR(255),
        programAbbr VARCHAR(14),
        programLong VARCHAR(100),
        std_num VARCHAR(20)
    );

CREATE TABLE
    CATEGORIES (
        acId INT PRIMARY KEY AUTO_INCREMENT,
        category VARCHAR(100) UNIQUE
    );

CREATE TABLE
    SELECTIONS (
        seId INT PRIMARY KEY AUTO_INCREMENT,
        module_name VARCHAR(255),
        session_time VARCHAR(11),
        venue VARCHAR(14),
        lab VARCHAR(200),
        capacity INT,
        who_takes INT,
        category VARCHAR(100)
    );

CREATE TABLE
    SUPERVISORS (
        sn INT PRIMARY KEY AUTO_INCREMENT,
        f_name VARCHAR(50),
        m_name VARCHAR(50),
        l_name VARCHAR(50),
        department VARCHAR(60),
        super_id VARCHAR(15) UNIQUE,
        mobile VARCHAR(14),
        e_mail VARCHAR(255),
        password VARCHAR(50) DEFAULT l_name
    );

CREATE TABLE
    PLACE_OF_SELECTION (
        prId INT PRIMARY KEY AUTO_INCREMENT,
        place_name VARCHAR(255),
        category VARCHAR(60),
        capacity INT,
        branch VARCHAR(100),
        area VARCHAR(60),
        region VARCHAR(60),
        district VARCHAR(60),
        supervisor VARCHAR(15)
    );

CREATE TABLE
    PROJECTS (
        pId INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255),
        category VARCHAR(100),
        domain VARCHAR(100),
        lab VARCHAR(200),
        descr TEXT,
        supervisor VARCHAR(255),
        remarks VARCHAR(250),
        students TEXT,
        years VARCHAR(10)
    );

CREATE TABLE
    SELECTED (
        selId INT PRIMARY KEY AUTO_INCREMENT,
        selection INT,
        student VARCHAR(20)
    );

CREATE TABLE
    CONTINUE_SELECTED (
        selId INT PRIMARY KEY AUTO_INCREMENT,
        selection INT,
        student VARCHAR(20)
    );

CREATE TABLE
    LOGBOOK (
        lId INT PRIMARY KEY AUTO_INCREMENT,
        date_created DATE DEFAULT CURRENT_TIMESTAMP,
        work_hours INT,
        week_no VARCHAR(10),
        task_description TEXT,
        task_for VARCHAR(20)
    );

ALTER TABLE LOGBOOK ADD FOREIGN KEY (task_for) REFERENCES STUDENTS (t_number) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ACADEMICINFOS ADD FOREIGN KEY (std_num) REFERENCES STUDENTS (t_number) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE PLACE_OF_SELECTION ADD FOREIGN KEY (category) REFERENCES CATEGORIES (category) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE SELECTIONS ADD FOREIGN KEY (category) REFERENCES CATEGORIES (category) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE PLACE_OF_SELECTION ADD FOREIGN KEY (supervisor) REFERENCES SUPERVISORS (super_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE SELECTED ADD FOREIGN KEY (selection) REFERENCES SELECTIONS (seId) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE SELECTED ADD FOREIGN KEY (student) REFERENCES STUDENTS (t_number) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE CONTINUE_SELECTED ADD FOREIGN KEY (selection) REFERENCES PLACE_OF_SELECTION (prId) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE CONTINUE_SELECTED ADD FOREIGN KEY (student) REFERENCES STUDENTS (t_number) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO
    STUDENTS (
        f_name,
        m_name,
        l_name,
        t_number,
        mobile,
        e_mail,
        gender
    )
VALUES
    (
        'Paulo',
        'Michael',
        'Lukwaro',
        'T22-03-10577',
        '0628272363',
        'paulprogrammer947@.com',
        'M'
    ),
    (
        'Jane',
        'Anne',
        'Doe',
        'T22-03-54321',
        '9876543210',
        'jane.doe@email.com',
        'F'
    ),
    (
        'Michael',
        'David',
        'Lee',
        'T22-03-98765',
        '0123456789',
        'michael.lee@email.com',
        'M'
    ),
    (
        'Alice',
        'Katherine',
        'Johnson',
        'T22-03-101112',
        '8765432109',
        'alice.johnson@email.com',
        'F'
    ),
    (
        'David',
        'Robert',
        'Williams',
        'T22-03-345678',
        '7654321089',
        'david.williams@email.com',
        'M'
    ),
    (
        'Elizabeth',
        'Sarah',
        'Brown',
        'T22-03-789012',
        '6543210987',
        'elizabeth.brown@email.com',
        'F'
    ),
    (
        'James',
        'William',
        'Miller',
        'T22-03-234567',
        '5432109876',
        'james.miller@email.com',
        'M'
    ),
    (
        'Jessica',
        'Jennifer',
        'Davis',
        'T22-03-678901',
        '4321098765',
        'jessica.davis@email.com',
        'F'
    ),
    (
        'Christopher',
        'Andrew',
        'Clark',
        'T22-03-012345',
        '3210987654',
        'christopher.clark@email.com',
        'M'
    ),
    (
        'Ashley',
        'Emily',
        'Wright',
        'T22-03-456789',
        '2109876543',
        'ashley.wright@email.com',
        'F'
    ),
    (
        'Matthew',
        'Joseph',
        'Moore',
        'T22-03-890123',
        '1098765432',
        'matthew.moore@email.com',
        'M'
    ),
    (
        'Sarah',
        'Nicole',
        'Lewis',
        'T22-03-123456',
        '0987654321',
        'sarah.lewis@email.com',
        'F'
    );

INSERT INTO
    CATEGORIES (category)
VALUES
    ('CSE'),
    ('Computer Vision'),
    ('Cryptography'),
    ('Internet of Things'),
    ('Structural Engineering'),
    ('Business Intelligence'),
    ('Accounting Information Systems'),
    ('Mobile App Development'),
    ('Natural Language Processing'),
    ('Network Security');

INSERT INTO
    ACADEMICINFOS (
        collegeAbbr,
        collegeLong,
        departmentAbbr,
        departmentLong,
        programAbbr,
        programLong,
        std_num
    )
VALUES
    (
        'COE',
        'College of Engineering',
        'EEE',
        'Electrical and Electronics Engineering',
        'BSc (EEE)',
        'Bachelor of Science (Electrical and Electronics Engineering)',
        'T22-03-123456'
    ),
    (
        'COE',
        'College of Engineering',
        'MEC',
        'Mechanical Engineering',
        'BSc (MEC)',
        'Bachelor of Science (Mechanical Engineering)',
        'T22-03-54321'
    ),
    (
        'COE',
        'College of Engineering',
        'CVE',
        'Civil Engineering',
        'BSc (CVE)',
        'Bachelor of Science (Civil Engineering)',
        'T22-03-98765'
    ),
    (
        'COB',
        'College of Business',
        'BBA',
        'Business Administration',
        'BBA',
        'Bachelor of Business Administration',
        'T22-03-101112'
    ),
    (
        'COB',
        'College of Business',
        'ACC',
        'Accounting',
        'BSc (Acc)',
        'Bachelor of Science (Accounting)',
        'T22-03-345678'
    );

INSERT INTO
    SELECTIONS (
        module_name,
        session_time,
        venue,
        lab,
        capacity,
        who_takes,
        category
    )
VALUES
    (
        'Operating Systems',
        'Morning',
        'EH 303',
        'OS Lab',
        40,
        123456,
        'CSE'
    ),
    (
        'Artificial Intelligence',
        'Morning',
        'EH 401',
        'AI Lab',
        35,
        987654,
        'CSE'
    ),
    (
        'Software Design Patterns',
        'TTH 15:00-16:00',
        'EH 101',
        'SDP Lab',
        45,
        543210,
        'CSE'
    ),
    (
        'Human-Computer Interaction',
        'Morning',
        'EH 201',
        'HCI Lab',
        30,
        210987,
        'CSE'
    ),
    (
        'Compiler Design',
        'Morning',
        'EH 402',
        'Compiler Lab',
        50,
        678901,
        'CSE'
    ),
    (
        'Computer Graphics',
        'MWF 13:00-14:00',
        'EH 204',
        'Graphics Lab',
        40,
        123456,
        'CSE'
    ),
    (
        'Information Retrieval',
        'TTH 14:00-15:00',
        'EH 302',
        'IR Lab',
        35,
        987654,
        'CSE'
    ),
    (
        'Machine Learning',
        'MWF 15:00-16:00',
        'EH 102',
        'ML Lab',
        45,
        543210,
        'CSE'
    ),
    (
        'Cryptography and Network Security',
        'TTH 08:00-09:00',
        'EH 203',
        'CNS Lab',
        30,
        210987,
        'CSE'
    ),
    (
        'Software Testing and Quality Assurance',
        'MWF 10:00-11:00',
        'EH 304',
        'STQA Lab',
        40,
        123456,
        'CSE'
    ),
    (
        'Parallel and Distributed Computing',
        'TTH 12:00-13:00',
        'EH 403',
        'PDC Lab',
        35,
        987654,
        'CSE'
    ),
    (
        'Software Project Management',
        'MWF 14:00-15:00',
        'EH 104',
        'SPM Lab',
        45,
        543210,
        'CSE'
    );

INSERT INTO
    SUPERVISORS (
        f_name,
        m_name,
        l_name,
        department,
        super_id,
        mobile,
        e_mail
    )
VALUES
    (
        'Dr.',
        '',
        'Brown',
        'Computer Science Engineering',
        'CSE YYY',
        '9876543219',
        'brown.cse@university.edu'
    ),
    (
        'Dr.',
        '',
        'Garcia',
        'Electrical and Electronics Engineering',
        'EEE ZZZ',
        '8765432198',
        'garcia.eee@university.edu'
    ),
    (
        'Dr.',
        '',
        'Nelson',
        'Mechanical Engineering',
        'MEC AAA',
        '7654321987',
        'nelson.mec@university.edu'
    ),
    (
        'Dr.',
        '',
        'King',
        'Civil Engineering',
        'CVE BBB',
        '6543219876',
        'king.cve@university.edu'
    ),
    (
        'Prof.',
        '',
        'Clark',
        'Business Administration',
        'BBA CCC',
        '5432198765',
        'clark.bba@university.edu'
    ),
    (
        'Dr.',
        '',
        'Miller',
        'Accounting',
        'ACC DDD',
        '4321987654',
        'miller.acc@university.edu'
    ),
    (
        'Dr.',
        '',
        'Davis',
        'Information and Communication Technology',
        'ICT EEE',
        '3219876543',
        'davis.ict@university.edu'
    ),
    (
        'Dr.',
        '',
        'Robinson',
        'Information Systems',
        'IS FFF',
        '2198765432',
        'robinson.is@university.edu'
    ),
    (
        'Dr.',
        '',
        'Lee',
        'Information Technology',
        'IT GGG',
        '1987654321',
        'lee.it@university.edu'
    ),
    (
        'Prof.',
        '',
        'Johnson',
        'Law',
        'LAW HHH',
        '0876543219',
        'johnson.law@university.edu'
    ),
    (
        'Dr.',
        '',
        'Williams',
        'Chemical Engineering',
        'CHE III',
        '9765432108',
        'williams.che@university.edu'
    ),
    (
        'Dr.',
        '',
        'Jackson',
        'Petroleum Engineering',
        'PET JJJ',
        '8654321097',
        'jackson.pet@university.edu'
    );

INSERT INTO
    PROJECTS (
        title,
        category,
        domain,
        lab,
        descr,
        supervisor,
        remarks,
        students,
        years
    )
VALUES
    (
        'An Intelligent System for Image Recognition',
        'Computer Vision',
        'Artificial Intelligence',
        'SE Lab 2',
        'This project aims to develop a deep learning model for accurate image recognition tasks.',
        'CSE YYY',
        'Needs further refinement of the model architecture.',
        'T22-03-12345, T22-03-54321',
        'FYP'
    ),
    (
        'Design and Implementation of a Secure E-Voting System',
        'Cryptography',
        'Cybersecurity',
        'Network Lab',
        'This project focuses on designing and implementing a secure electronic voting system that ensures confidentiality and integrity of votes.',
        'PET JJJ',
        'Potential for real-world implementation after further testing.',
        'T22-03-98765, T22-03-101112',
        'FYP'
    ),
    (
        'Development of a Smart Irrigation System using IoT',
        'Internet of Things',
        'Agriculture',
        'NA',
        'This project involves designing and building a smart irrigation system that utilizes sensors and actuators to optimize water usage in agriculture.',
        'EEE ZZZ',
        'Successful prototype developed. Further research needed for cost-effectiveness.',
        'T22-03-345678, T22-03-789012',
        'FYP'
    ),
    (
        'Structural Analysis of High-Rise Buildings',
        'Structural Engineering',
        'Civil Engineering',
        'NA',
        'This project utilizes finite element analysis to assess the structural integrity of high-rise buildings under various loading conditions.',
        'MEC AAA',
        'Rigorous analysis performed. Project can be extended to include seismic considerations.',
        'T22-03-234567, T22-03-678901',
        'FYP'
    ),
    (
        'Developing a Financial Management Dashboard for Businesses',
        'Business Intelligence',
        'Financial Management',
        'NA',
        'This project involves designing and implementing a web-based dashboard to provide real-time financial insights for businesses.',
        'BBA CCC',
        'User-friendly interface developed. Additional functionalities can be incorporated.',
        'T22-03-012345, T22-03-456789',
        'FYP'
    ),
    (
        'An Accounting Information System for Small and Medium Enterprises',
        'Accounting Information Systems',
        'Accounting',
        'NA',
        'This project aims to develop a user-friendly accounting information system to cater to the needs of small and medium enterprises.',
        'ACC DDD',
        'Functional prototype developed. Further development required for integration with financial institutions.',
        'T22-03-890123, T22-03-123456',
        'FYP'
    ),
    (
        'Design and Development of a Mobile Application for E-Learning',
        'Mobile App Development',
        'Education Technology',
        'NA',
        'This project focuses on designing and developing a mobile application to facilitate effective e-learning experiences.',
        'ICT EEE',
        'Mobile app prototype with core functionalities completed. Further testing and refinement required.',
        'T22-03-123457, T22-03-345678',
        'FYP'
    ),
    (
        'Building a Chatbot for Customer Service',
        'Natural Language Processing',
        'Artificial Intelligence',
        'NA',
        'This project involves developing a chatbot that can interact with customers in a natural language to answer queries and provide support.',
        'IS FFF',
        'Chatbot prototype with basic functionalities implemented. More advanced features can be added.',
        'T22-03-789012, T22-03-012345',
        'FYP'
    ),
    (
        'Network Intrusion Detection System (NIDS) for Cybersecurity',
        'Network Security',
        'Cybersecurity',
        'Network Lab',
        'This project aims to design and implement a network intrusion detection system to identify and prevent malicious network activities.',
        'IT GGG',
        'NIDS prototype developed with promising results. Further optimization and rule-base development required.',
        'T22-03-54321, T22-03-890123',
        'FYP'
    );

INSERT INTO
    `PLACE_OF_SELECTION` (
        `prId`,
        `place_name`,
        `category`,
        `capacity`,
        `branch`,
        `area`,
        `region`,
        `district`,
        `supervisor`
    )
VALUES
    (
        1,
        'Central Hall',
        'Network Security',
        100,
        'Main Campus',
        'Central Area',
        'Central Region',
        'City Center',
        'MEC AAA'
    ),
    (
        2,
        'Library Room',
        'Network Security',
        50,
        'Main Campus',
        'Central Area',
        'Central Region',
        'City Center',
        'MEC AAA'
    ),
    (
        3,
        'EH 101',
        'Network Security',
        30,
        'Main Campus',
        'Eastern Area',
        'Central Region',
        'City Center',
        'CHE III'
    ),
    (
        4,
        'EH 201',
        'Network Security',
        25,
        'Main Campus',
        'Eastern Area',
        'Central Region',
        'City Center',
        'ACC DDD'
    ),
    (
        5,
        'EH 303',
        'Network Security',
        35,
        'Main Campus',
        'Eastern Area',
        'Central Region',
        'City Center',
        'IS FFF'
    ),
    (
        6,
        'EH 401',
        'Network Security',
        40,
        'Main Campus',
        'Eastern Area',
        'Central Region',
        'City Center',
        'IS FFF'
    ),
    (
        7,
        'EH 201',
        'Network Security',
        25,
        'Main Campus',
        'Eastern Area',
        'Central Region',
        'City Center',
        'LAW HHH'
    );

INSERT INTO
    `CONTINUE_SELECTED` (`selId`, `selection`, `student`)
VALUES
    (NULL, '3', 'T22-03-101112'),
    (NULL, '3', 'T22-03-456789'),
    (NULL, '3', 'T22-03-234567'),
    (NULL, '7', 'T22-03-789012'),
    (NULL, '4', 'T22-03-234567'),
    (NULL, '6', 'T22-03-789012');

INSERT INTO
    `ACADEMICINFOS` (
        `acId`,
        `collegeAbbr`,
        `collegeLong`,
        `departmentAbbr`,
        `departmentLong`,
        `programAbbr`,
        `programLong`,
        `std_num`
    )
VALUES
    (
        NULL,
        'CIVE',
        'College of Information and Virtual Education ',
        'CSE',
        'Department of Computer Science and Engineering',
        'BSc. CS2',
        'Bachelor of  Science in Computer Science',
        'T22-03-10577'
    );

INSERT INTO
    `PLACE_OF_SELECTION` (
        `prId`,
        `place_name`,
        `category`,
        `capacity`,
        `branch`,
        `area`,
        `region`,
        `district`,
        `supervisor`
    )
VALUES
    (
        NULL,
        'Vodacom Internet Company',
        'CSE',
        '3',
        'Mawasiliano',
        'Makumbusho',
        'Dar es Salaam',
        'Ubungo',
        'IS FFF'
    );