<?php

/**
 * This is the model class for table "cart_items".
 *
 * The followings are the available columns in table 'cart_items':
 * @property string $id
 * @property string $cart_id
 * @property string $product_id
 * @property string $product_node_id
 * @property integer $quantity
 * @property string $price
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Cart $cart
 */
class CartItem extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return CartItem the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cart_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cart_id, product_id, product_node_id', 'required'),
            array('quantity', 'numerical', 'integerOnly' => true),
            array('cart_id, product_id, product_node_id', 'length', 'max' => 11),
            array('price', 'length', 'max' => 15),
            array('created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, cart_id, product_id, product_node_id, quantity, price, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'productNode' => array(self::BELONGS_TO, 'ProductNode', 'product_node_id'),
            'cart' => array(self::BELONGS_TO, 'Cart', 'cart_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cart_id' => 'Cart',
            'product_id' => 'Product',
            'product_node_id' => 'Product Node',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'created' => 'Created',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('cart_id', $this->cart_id, true);
        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('product_node_id', $this->product_node_id, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('created', $this->created, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}