<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{

    public $roleName;
    public $statusName;
    public $creatorName;
    public $createdDate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role_id', 'status_id', 'created_by', 'updated_by'], 'integer'],
            [['username', 'email', 'created_at', 'createdDate', 'roleName', 'statusName', 'creatorName', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
           'attributes' => [
               'id',
               'username',
               'email',
               'roleName' => [
                   'asc' => ['role.role_name' => SORT_ASC],
                   'desc' => ['role.role_name' => SORT_DESC],
                   'label' => 'Role'
               ],
               'status_id',
               'statusName' => [
                   'asc' => ['status.status_name' => SORT_ASC],
                   'desc' => ['status.status_name' => SORT_DESC],
                   'label' => 'Status'
               ],
               'created_at',
               'created_by',
               'creatorName' => [
                   'asc' => ['user.username' => SORT_ASC],
                   'desc' => ['user.username' => SORT_DESC],
                   'label' => 'Creator'
               ],
               'createdDate' => [
                   'asc' => ['user.created_at' => SORT_ASC],
                   'desc' => ['user.created_at' => SORT_DESC],
                   'label' => 'Created Date'
               ],
           ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['role'])->joinWith(['status']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'role_id' => $this->role_id,
            'status_id' => $this->status_id,
            //'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);


        // filter by country name

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'email', $this->email])

            ->joinWith(['role' => function ($roleQuery) {
                $roleQuery->where('role.role_name LIKE "%' . $this->roleName . '%"');
            }])
            ->joinWith(['status' => function ($statusQuery) {
                $statusQuery->where('status.status_name LIKE "%' . $this->statusName . '%"');
            }])
            ->andFilterWhere(['like', 'created_at', $this->createdDate])
            ->andFilterWhere(['like', 'username', $this->creatorName]);

        return $dataProvider;


    }
}
