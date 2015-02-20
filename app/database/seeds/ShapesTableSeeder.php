<?php

class ShapesTableSeeder extends Seeder {

    public function run() {
        Shape::unguard();

        Shape::create([
            'id' => 4,
            'strip_id' => 13,
            'user_id' => 3,
            'created_at' => '2015-02-18 09:31:42',
            'updated_at' => '2015-02-18 09:31:42',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'value' => '{"objects":[{"type":"image","width":696,"height":938,"src":"/uploads/0/4add9b73d5ab647ee47aebcd0438eb30","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":130,"top":218.5,"width":164,"height":76,"fill":"#ffffff","rx":82,"ry":38},{"type":"ellipse","left":44,"top":614.5,"fill":"#ffffff","rx":0,"ry":0},{"type":"ellipse","left":9,"top":579.42,"width":162,"height":78,"fill":"#ffffff","scaleX":0.8,"scaleY":0.8,"rx":81,"ry":39},{"type":"ellipse","left":142,"top":833.5,"width":158,"height":8,"fill":"#ffffff","scaleX":0.89,"scaleY":7.63,"rx":79,"ry":4},{"type":"ellipse","left":428,"top":766.5,"width":148,"height":50,"fill":"#ffffff","scaleX":0.8,"rx":74,"ry":25},{"type":"ellipse","left":627,"top":675.5,"width":46,"height":30,"fill":"#ffffff","rx":23,"ry":15}],"background":""}'
        ]);

        Shape::create([
            'id' => 5,
            'strip_id' => 14,
            'user_id' => 3,
            'created_at' => '2015-02-18 16:41:24',
            'updated_at' => '2015-02-18 16:41:24',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'value' => '{"objects":[{"type":"image","width":738,"height":956,"src":"/uploads/0/07f485e2f27eb5916a5cff7835bab148","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"}],"background":""}'
        ]);

        Shape::create([
            'id' => 6,
            'strip_id' => 15,
            'user_id' => 3,
            'created_at' => '2015-02-18 16:43:17',
            'updated_at' => '2015-02-18 16:43:17',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'value' => '{"objects":[{"type":"image","width":668,"height":871,"src":"/uploads/0/867cd02c9ebb7273fbe546f4ae8efd9e","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":216.23,"top":801.5,"width":46,"height":34,"fill":"#ffffff","rx":23,"ry":17}],"background":""}'
        ]);

        Shape::create([
            'id' => 7,
            'strip_id' => 16,
            'user_id' => 3,
            'created_at' => '2015-02-18 16:46:29',
            'updated_at' => '2015-02-18 16:46:29',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'value' => '{"objects":[{"type":"image","width":668,"height":871,"src":"/uploads/0/6d6acd0feec256e7c66792a045c9d48e","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":363.23,"top":16.5,"width":190,"height":68,"fill":"#ffffff","scaleX":0.92,"scaleY":0.94,"rx":95,"ry":34},{"type":"ellipse","left":399.41,"top":233.32,"width":204,"height":50,"fill":"#ffffff","scaleX":1.02,"scaleY":1.02,"rx":102,"ry":25},{"type":"ellipse","left":29.23,"top":193.17,"width":218,"height":66,"fill":"#ffffff","scaleX":0.98,"scaleY":0.94,"rx":109,"ry":33},{"type":"ellipse","left":2.23,"top":332.5,"width":194,"height":24,"fill":"#ffffff","scaleY":1.25,"rx":97,"ry":12},{"type":"ellipse","left":231.23,"top":336.5,"width":66,"height":22,"fill":"#ffffff","scaleX":1.11,"scaleY":1.14,"rx":33,"ry":11},{"type":"ellipse","left":1.23,"top":643.5,"width":186,"height":36,"fill":"#ffffff","scaleX":0.93,"rx":93,"ry":18},{"type":"ellipse","left":368.23,"top":782.5,"width":62,"height":24,"fill":"#ffffff","rx":31,"ry":12},{"type":"ellipse","left":482.23,"top":65.5,"fill":"#ffffff","rx":0,"ry":0}],"background":""}'
        ]);

        Shape::create([
            'id' => 8,
            'strip_id' => 17,
            'user_id' => 3,
            'value' => '{"objects":[{"type":"image","width":668,"height":871,"src":"/uploads/0/3320eba7f169f693dcdb4341e34075f8","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":21.23,"top":10.5,"width":124,"height":24,"fill":"#ffffff","rx":62,"ry":12},{"type":"ellipse","left":56.23,"top":161.7,"width":178,"height":76,"fill":"#ffffff","scaleX":1.04,"scaleY":1.02,"rx":89,"ry":38},{"type":"ellipse","left":310.23,"top":184.5,"width":174,"height":40,"fill":"#ffffff","scaleX":0.95,"scaleY":1.15,"rx":87,"ry":20},{"type":"ellipse","left":482.23,"top":2.5,"width":178,"height":70,"fill":"#ffffff","scaleY":0.87,"rx":89,"ry":35},{"type":"ellipse","left":201.98,"top":245.5,"width":86,"height":32,"fill":"#ffffff","scaleX":0.72,"scaleY":0.64,"rx":43,"ry":16},{"type":"ellipse","left":330.23,"top":287.15,"width":104,"height":32,"fill":"#ffffff","scaleX":0.85,"scaleY":0.82,"rx":52,"ry":16},{"type":"ellipse","left":446.23,"top":236.5,"width":198,"height":28,"fill":"#ffffff","scaleY":0.96,"rx":99,"ry":14},{"type":"ellipse","left":533.23,"top":281.5,"width":126,"height":44,"fill":"#ffffff","rx":63,"ry":22},{"type":"ellipse","left":508.23,"top":395.5,"width":62,"height":32,"fill":"#ffffff","scaleX":0.76,"scaleY":0.76,"rx":31,"ry":16},{"type":"ellipse","left":9.23,"top":421.5,"width":264,"height":46,"fill":"#ffffff","scaleX":0.75,"scaleY":0.58,"rx":132,"ry":23},{"type":"ellipse","left":26.23,"top":644.5,"width":158,"height":36,"fill":"#ffffff","rx":79,"ry":18},{"type":"ellipse","left":63.23,"top":711.5,"width":116,"height":22,"fill":"#ffffff","scaleX":0.91,"rx":58,"ry":11}],"background":""}',
            'created_at' => '2015-02-19 17:13:17',
            'updated_at' => '2015-02-19 17:13:17',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
        ]);

        Shape::create([
            'id' => 9,
            'strip_id' => 19,
            'user_id' => 3,
            'created_at' => '2015-02-18 16:48:11',
            'validated_at' => '2015-02-18 16:48:11',
            'value' => '{"objects":[{"type":"image","width":596,"height":800,"src":"/uploads/0/06ad150fa0d0e67062822cf4bcaaa70a","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"rect","left":5.08,"top":22.5,"width":567,"height":131,"fill":"#ffffff"},{"type":"rect","left":370.08,"top":409.5,"width":210,"height":269,"fill":"#ffffff"}],"background":""}',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
        ]);

        Shape::create([
            'id' => 10,
            'strip_id' => 18,
            'user_id' => 3,
            'value' => '{"objects":[{"type":"image","width":668,"height":871,"src":"/uploads/0/ae5fd4b465982ce4c7611506189e4c66","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":280.23,"top":4.5,"width":146,"height":38,"fill":"#ffffff","rx":73,"ry":19},{"type":"ellipse","left":248.23,"top":53.5,"width":176,"height":58,"fill":"#ffffff","scaleX":0.88,"scaleY":1.17,"rx":88,"ry":29},{"type":"ellipse","left":489.23,"top":118.5,"width":166,"height":88,"fill":"#ffffff","scaleX":1.02,"scaleY":0.91,"rx":83,"ry":44},{"type":"ellipse","left":438.23,"top":236.5,"width":122,"height":26,"fill":"#ffffff","scaleX":0.96,"scaleY":1.38,"rx":61,"ry":13},{"type":"ellipse","left":39.23,"top":211.5,"width":162,"height":52,"fill":"#ffffff","scaleX":0.93,"scaleY":1.27,"rx":81,"ry":26},{"type":"ellipse","left":11.23,"top":284.5,"width":156,"height":86,"fill":"#ffffff","scaleX":0.9,"scaleY":1.06,"rx":78,"ry":43},{"type":"ellipse","left":206.23,"top":441.5,"width":120,"height":58,"fill":"#ffffff","scaleY":1.03,"rx":60,"ry":29},{"type":"ellipse","left":388.23,"top":479.01,"width":200,"height":44,"fill":"#ffffff","scaleX":1.06,"scaleY":0.9,"rx":100,"ry":22},{"type":"ellipse","left":104.23,"top":511.5,"width":160,"height":24,"fill":"#ffffff","scaleX":0.94,"rx":80,"ry":12},{"type":"ellipse","left":7.23,"top":550.5,"width":130,"height":56,"fill":"#ffffff","scaleX":0.9,"rx":65,"ry":28},{"type":"ellipse","left":165.23,"top":723.5,"width":110,"height":26,"fill":"#ffffff","rx":55,"ry":13},{"type":"ellipse","left":121.23,"top":822.5,"width":190,"height":20,"fill":"#ffffff","scaleX":0.97,"rx":95,"ry":10},{"type":"ellipse","left":316.23,"top":541.5,"width":150,"height":80,"fill":"#ffffff","scaleY":0.9,"rx":75,"ry":40},{"type":"ellipse","left":318.23,"top":753.5,"width":166,"height":76,"fill":"#ffffff","scaleX":0.95,"scaleY":1.07,"rx":83,"ry":38},{"type":"ellipse","left":520.23,"top":805.5,"width":112,"height":22,"fill":"#ffffff","rx":56,"ry":11}],"background":""}',
            'created_at' => '2015-02-20 12:08:28',
            'updated_at' => '2015-02-20 12:08:28',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);

        Shape::create([
            'id' => 16,
            'strip_id' => 20,
            'user_id' => 3,
            'value' => '{"objects":[{"type":"image","width":668,"height":871,"src":"/uploads/0/610ff4d9cf2fabbf9ba7eac9ff7bfc2b","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":374.23,"top":144.5,"width":100,"height":36,"fill":"#ffffff","rx":50,"ry":18},{"type":"ellipse","left":260.23,"top":270.5,"width":218,"height":32,"fill":"#ffffff","scaleX":0.95,"scaleY":1.16,"rx":109,"ry":16},{"type":"ellipse","left":18.23,"top":549.5,"width":126,"height":32,"fill":"#ffffff","scaleY":1.22,"rx":63,"ry":16},{"type":"ellipse","left":422.23,"top":504.5,"width":138,"height":44,"fill":"#ffffff","scaleX":0.95,"rx":69,"ry":22},{"type":"rect","left":9.23,"top":621.5,"width":645,"height":36,"fill":"#ffffff"}],"background":""}',
            'created_at' => '2015-02-20 12:57:10',
            'updated_at' => '2015-02-20 12:57:10',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);
    }

}
