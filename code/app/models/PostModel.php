<?php
require_once __DIR__.'/../helpers/model-helpers.php';

class PostModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * @param int $postId
     * @return array{post_id, username, post_title, post_body, post_image, post_date}
     * Array representing data of a single post, or null if no post with that id exists.
     */
    public function getPostById(int $postId): ?array {
        $statement = $this->db->prepare(<<<sql
            SELECT *
            FROM posts
            WHERE post_id = :postId
        sql);
        $statement->bindValue(":postId", $postId);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $result['post_image'] = addImageMimeType($result['post_image']);
        }

        return $result ? $result : null;
    }

    /**
     * @return array
     * Array of postData arrays, each with keys {post_id, username, post_title, post_body, post_image, post_date},
     * ordered by most recent post_date first.
     */
    public function getRecentPosts(): array {
        $statement = $this->db->query(<<<sql
            SELECT *
            FROM posts
            ORDER BY post_date DESC
        sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as &$result) {
            $result['post_image'] = addImageMimeType($result['post_image']);
        }
        unset($result);
        return $results;
    }

    /**
     * @return array
     * Array of postData arrays, each with keys {post_id, username, post_title, post_body, post_image, post_date},
     * ordered by most liked first (but only includes posts from the last week)
     */
    public function getPopularPosts(): array {
        $statement = $this->db->query(<<<sql
            SELECT
                posts.post_id AS post_id,
                posts.username AS username,
                post_title,
                post_body,
                post_image,
                post_date
            FROM posts
                JOIN likes
                ON posts.post_id = likes.post_id
            WHERE
                post_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)
            GROUP BY
                posts.post_id
            ORDER BY
                COUNT(likes.post_id) DESC, post_date DESC
        sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as &$result) {
            $result['post_image'] = addImageMimeType($result['post_image']);
        }
        unset($result);
        return $results;
    }

    /**
     * @return array
     * Array of postData arrays for posts saved by this user,
     * each with keys {post_id, username, post_title, post_body, post_image, post_date},
     * ordered by most recent save_date first.
     */
    public function getSavedPosts($username): array {
        $statement = $this->db->prepare(<<<sql
            SELECT
                posts.post_id AS post_id,
                posts.username AS username,
                post_title,
                post_body,
                post_image,
                post_date
            FROM posts
                JOIN saves
                ON posts.post_id = saves.post_id
            WHERE
                saves.username = ?
            ORDER BY
                save_date DESC
        sql);
        $statement->execute([$username]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as &$result) {
            $result['post_image'] = addImageMimeType($result['post_image']);
        }
        unset($result);
        return $results;
    }

    /**
     * @return array
     * Array of postData arrays for a specific user,
     * each with keys {post_id, username, post_title, post_body, post_image, post_date},
     * ordered by most recent post_date first.
     */
    public function getUserPosts(string $username): array {
        $statement = $this->db->prepare(<<<sql
            SELECT *
            FROM posts
            WHERE username = ?
            ORDER BY post_date DESC
        sql);
        $statement->execute([$username]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as &$result) {
            $result['post_image'] = addImageMimeType($result['post_image']);
        }
        unset($result);
        return $results;
    }

    /**
     * @param array $keywords Array of strings, any of which can match the title
     * @return array a list of posts with all the normal keys, ordered by number of matches first
     */
    public function getSearchedPosts(array $keywords = []): array {

        // PREPARE SQL STATEMENT
        $matchCalculationParts = array_fill(0, count($keywords), 'IF(post_title LIKE ?, 1, 0)');
        $whereClauseParts = array_fill(0, count($keywords), 'post_title LIKE ?');

        $matchCalculation = implode(' + ', $matchCalculationParts);
        $whereClause = implode(' OR ', $whereClauseParts);

        $statement =$this->db->prepare(<<<sql
            SELECT *, ($matchCalculation) AS num_matches
            FROM posts
            WHERE $whereClause
            ORDER BY num_matches DESC, post_date DESC
        sql);

        // BIND VALUES AND EXECUTE STATEMENT
        $values = [];
        foreach ($keywords as $keyword) {
            $values[] = "%$keyword%";
        }

        // Note: values must be bound twice; once for matchCalculation and once for whereClause
        $valuesTwice = array_merge($values, $values); 
        $statement->execute($valuesTwice); 

        // GET RESULTS
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as &$result) {
            $result['post_image'] = addImageMimeType($result['post_image']);
        }
        unset($result);
        return $results;
    }

    public function createPost(array $postData) {
        //write out all details of the post
        $imageBlob = file_get_contents($postData['post_image']['tmp_name']);

        $statement = $this->db->prepare(<<<SQL
            INSERT INTO posts(username, post_title, post_body, post_image)
            VALUES (?, ?, ?, ?);
        SQL);

        $statement->bindValue(1, $postData['username']);    
        $statement->bindValue(2, $postData['post_title']);
        $statement->bindValue(3, $postData['post_body']);
        $statement->bindValue(4, $imageBlob);
        
        $statement->execute();
    }

    public function updatePost(array $postData) {
        if (isset($postData['post_image'])) {
            $imageBlob = file_get_contents($postData['post_image']['tmp_name']);
            
            $statement = $this->db->prepare(<<<SQL
                UPDATE posts
                SET post_title = :title,
                    post_body = :body,
                    post_image = :image
                WHERE post_id = :postId
            SQL);
            
            $statement->bindValue(':title', $postData['post_title']);
            $statement->bindValue(':body', $postData['post_body']);
            $statement->bindValue(':image', $imageBlob);
            $statement->bindValue(':postId', $postData['post_id']);
        } else {
            $statement = $this->db->prepare(<<<SQL
                UPDATE posts
                SET post_title = :title,
                    post_body = :body
                WHERE post_id = :postId
            SQL);
            
            $statement->bindValue(':title', $postData['post_title']);
            $statement->bindValue(':body', $postData['post_body']);
            $statement->bindValue(':postId', $postData['post_id']);
        }
        
        $statement->execute();
    }

    public function deletePost(int $postId) {
        $statement = $this->db->prepare(<<<SQL
            DELETE FROM posts
            WHERE post_id = :postId
        SQL);
        $statement->bindValue(':postId', $postId);
        $statement->execute();
    }

    /**
     * @return array 
     * Returns an array of total number of posts, number of posts made in the 
     * last 7 days, and the number of posts made today.
     */
    public function getPostAnalytics(): array {
        $statement = $this->db->query(<<<SQL
            SELECT
                (SELECT COUNT(*) FROM posts) AS total_posts,
                (SELECT COUNT(*) FROM posts WHERE post_date >= NOW() - INTERVAL 1 WEEK) AS posts_last_week,
                (SELECT COUNT(*) FROM posts WHERE post_date >= CURDATE()) AS posts_today
        SQL);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return array
     * Array of postData arrays with keys {post_id, username, post_title, likes},
     * ordered by most likes, then by most recent post_date first.
     */
    public function getMostLikedPosts(): array {
        $statement = $this->db->query(<<<SQL
            SELECT
                posts.post_id AS post_id,
                posts.username AS username,
                post_title,
                COUNT(likes.post_id) AS likes
            FROM posts
                JOIN likes
                ON posts.post_id = likes.post_id
            GROUP BY
                posts.post_id
            ORDER BY
                COUNT(likes.post_id) DESC, post_date DESC
            LIMIT 5
        SQL);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>
