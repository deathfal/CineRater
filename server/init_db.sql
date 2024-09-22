CREATE TABLE users (
    id VARCHAR(255) PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activation_token VARCHAR(255),
    role VARCHAR(50) NOT NULL DEFAULT 'unverified'
);






-- Create Movies Table
CREATE TABLE IF NOT EXISTS movies (
    id VARCHAR(12) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL
);





-- insert Movies 
INSERT INTO movies (id, title, description, image) VALUES
('4b9d23fbbeca', 'Fight Club', 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much more.', '../../assets/img/movies/fight-club.png'),
('a834b29d12cc', 'Lord of the Rings', 'A young hobbit, Frodo, has been entrusted with an ancient ring. Now he must embark on an epic quest to destroy the One Ring.', '../../assets/img/movies/LOR.png'),
('c49e4a67284d', 'Back to the Future', 'Marty McFly, a teenager, is accidentally sent thirty years into the past in a time-traveling DeLorean invented by his close friend, eccentric scientist Doc Brown.', '../../assets/img/movies/btf.png'),
('a9cde7ffaf92', 'The Dark Knight', 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.', '../../assets/img/movies/dark-knight.png'),
('8e29bcff7a3d', 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity''s survival.', '../../assets/img/movies/interstellar.png'),
('19faec4cda84', 'Inception', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.', '../../assets/img/movies/inception.png'),
('3fb7c9a58a14', 'The Silence of the Lambs', 'A young F.B.I. cadet must receive the help of an incarcerated and manipulative cannibal killer to catch another serial killer.', '../../assets/img/movies/hanibal.png'),
('b21c35da9f0b', 'Goodfellas', 'The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen Hill and his mob partners.', '../../assets/img/movies/goodfellas.png'),
('e91bc1ad0a4e', 'The Godfather', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', '../../assets/img/movies/the-godfather.png'),
('74f85a6e91ab', 'The Terminator', 'A cyborg assassin is sent from the future to kill a woman whose unborn son is destined to lead humanity against the machines.', '../../assets/img/movies/terminator.png'),
('fb137c9bc4a3', 'Seven', 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.', '../../assets/img/movies/seven.png'),
('9b47a4d6c2f1', 'The Matrix', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', '../../assets/img/movies/matrix.png'),
('d1c59ae73a9c', '12 Angry Men', 'A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence.', '../../assets/img/movies/12-angry-men.png');
