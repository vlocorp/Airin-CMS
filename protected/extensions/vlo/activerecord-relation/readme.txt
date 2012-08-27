COMPLETE GUIDE OPEN http://www.yiiframework.com/extension/activerecord-relation-behavior/

1. ADD THIS TO MODEL WHICH USE THIS

    public function behaviors() {
        return array(
            'activerecord-relation' => array(
                'class' => 'ext.vlo.activerecord-relation.EActiveRecordRelationBehavior', //path of extension
            )
        );
    }


2. MODEL EXAMPLE RELATION

class Post extends CActiveRecord
{
    // ...
    public function relations()
    {
        return array(
            'author'     => array(self::BELONGS_TO, 'User',     'author_id'),
            'categories' => array(self::MANY_MANY,  'Category', 'tbl_post_category(post_id, category_id)'),
        );
    }
}
 
class User extends CActiveRecord
{
    // ...
    public function relations()
    {
        return array(
            'posts'   => array(self::HAS_MANY, 'Post',    'author_id'),
            'profile' => array(self::HAS_ONE,  'Profile', 'owner_id'),
        );
    }
}



3. HOW TO USE

$user = new User();
    $user->posts = array(1,2,3);
    $user->save();
    // user is now author of posts 1,2,3
 
    // this is equivalent to the last example:
    $user = new User();
    $user->posts = Post::model()->findAllByPk(array(1,2,3));
    $user->save();
    // user is now author of posts 1,2,3
 
    $user->posts = array_merge($user->posts, array(4));
    $user->save();
    // user is now also author of post 4
 
    $user->posts = array();
    $user->save();
    // user is not related to any post anymore
 
    $post = Post::model()->findByPk(2);
    $post->author = User::model()->findByPk(1);
    $post->categories = array(2, Category::model()->findByPk(5));
    $post->save();
    // post 2 has now author 1 and belongs to categories 1 and 5
 
    // adding a profile to a user:
    $user->profile = new Profile();
    $user->profile->save(); // need this to ensure profile got a primary key
    $user->save();

