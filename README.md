DynamicModel
=============
Use any table as model without special Model class for each.
## Just specify table name when using model
```php
    //adding new entry
    $model = vendor\yii-ext\dynamic-model\DynamicModel::model('TableName');
    $model->attributeName = 'test';
    $model->save();

    //searching for all entries
    $findAll = vendor\yii-ext\dynamic-model\DynamicModel::model('TableName')->findAll();
    //etc...
