<?php

class StripsSeeder extends Seeder {

    public function run() {
        Strips::unguard();

        Strips::create([
            'id' => 1,
            'title' => 'Je suis projet',
            'path' => '/uploads/0/363b1c29fe79ecbd4a1777201ce11dee',
        ]);
        Strips::create([
            'id' => 2,
            'title' => 'Portable du père',
            'path' => '/uploads/0/cdb8a777ccf2c7c539cafe4e670c72e2',
        ]);
        Strips::create([
            'id' => 3,
            'title' => 'Devop ?',
            'path' => '/uploads/0/58f19710798ee712be8efaeba131f768',
        DB::table('strips')->insert([
            [
                'id' => 1,
                'title' => 'Je suis projet',
                'path' => '/uploads/0/363b1c29fe79ecbd4a1777201ce11dee',
                'validated_at' => '2015-02-10 11:12:32',
                'created_at' => '2015-02-10 10:49:43',
                'updated_at' => '2015-02-10 10:49:43'
            ],
            [
                'id' => 2,
                'title' => 'Portable du père',
                'path' => '/uploads/0/cdb8a777ccf2c7c539cafe4e670c72e2',
                'validated_at' => '2015-02-10 12:06:22',
                'created_at' => '2015-02-10 10:50:01',
                'updated_at' => '2015-02-10 10:50:01'
            ],
            [
                'id' => 3,
                'title' => 'Devop ?',
                'path' => '/uploads/0/58f19710798ee712be8efaeba131f768',
                'validated_at' => NULL,
                'created_at' => '2015-02-10 10:50:09',
                'updated_at' => '2015-02-10 10:50:09',
                'cleanning' => '{"objects":[{"type":"image","originX":"left","originY":"top","left":0,"top":0,"width":510,"height":696,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":0.85,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","src":"http://localhost:8000/uploads/0/f4db0c88545b5e7bcadc0cd7b6cc0158","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"rect","originX":"left","originY":"top","left":131.9,"top":49,"width":166,"height":103,"fill":"#ffffff","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","rx":0,"ry":0},{"type":"rect","originX":"left","originY":"top","left":63.9,"top":213,"width":44,"height":93,"fill":"#ffffff","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","rx":0,"ry":0},{"type":"ellipse","originX":"left","originY":"top","left":200.9,"top":208,"width":194,"height":132,"fill":"#ffffff","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","rx":97,"ry":66},{"type":"ellipse","originX":"left","originY":"top","left":35.9,"top":53,"width":150,"height":58,"fill":"#ff0000","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","rx":75,"ry":29},{"type":"ellipse","originX":"left","originY":"top","left":362.9,"top":41,"width":68,"height":52,"fill":"#ff0000","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","rx":34,"ry":26},{"type":"path","originX":"center","originY":"center","left":225.9,"top":474.5,"width":218,"height":177,"fill":null,"stroke":"#ff0000","strokeWidth":20,"strokeDashArray":null,"strokeLineCap":"round","strokeLineJoin":"round","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","path":[["M",163.4000244140625,447],["Q",163.4000244140625,447,163.9000244140625,447],["Q",164.4000244140625,447,166.1500244140625,447],["Q",167.9000244140625,447,175.9000244140625,447],["Q",183.9000244140625,447,196.9000244140625,447],["Q",209.9000244140625,447,219.4000244140625,447],["Q",228.9000244140625,447,235.9000244140625,447],["Q",242.9000244140625,447,249.4000244140625,447],["Q",255.9000244140625,447,260.9000244140625,447],["Q",265.9000244140625,447,268.4000244140625,447],["Q",270.9000244140625,447,273.4000244140625,449],["Q",275.9000244140625,451,277.9000244140625,454],["Q",279.9000244140625,457,282.4000244140625,461.5],["Q",284.9000244140625,466,285.9000244140625,470],["Q",286.9000244140625,474,287.9000244140625,477.5],["Q",288.9000244140625,481,289.4000244140625,483],["Q",289.9000244140625,485,290.4000244140625,486],["Q",290.9000244140625,487,291.4000244140625,487.5],["Q",291.9000244140625,488,293.9000244140625,488.5],["Q",295.9000244140625,489,298.4000244140625,489],["Q",300.9000244140625,489,304.4000244140625,488],["Q",307.9000244140625,487,310.9000244140625,484],["Q",313.9000244140625,481,316.4000244140625,477.5],["Q",318.9000244140625,474,321.9000244140625,469],["Q",324.9000244140625,464,326.9000244140625,458.5],["Q",328.9000244140625,453,330.9000244140625,446],["Q",332.9000244140625,439,333.9000244140625,430.5],["Q",334.9000244140625,422,334.9000244140625,414],["Q",334.9000244140625,406,334.9000244140625,402.5],["Q",334.9000244140625,399,333.9000244140625,394.5],["Q",332.9000244140625,390,329.9000244140625,388],["Q",326.9000244140625,386,324.4000244140625,386],["Q",321.9000244140625,386,318.4000244140625,386],["Q",314.9000244140625,386,308.4000244140625,392.5],["Q",301.9000244140625,399,296.4000244140625,408],["Q",290.9000244140625,417,283.9000244140625,429.5],["Q",276.9000244140625,442,270.4000244140625,456.5],["Q",263.9000244140625,471,257.4000244140625,484],["Q",250.9000244140625,497,246.9000244140625,505],["Q",242.9000244140625,513,235.9000244140625,520.5],["Q",228.9000244140625,528,222.4000244140625,534],["Q",215.9000244140625,540,209.4000244140625,543.5],["Q",202.9000244140625,547,196.9000244140625,550],["Q",190.9000244140625,553,185.4000244140625,554.5],["Q",179.9000244140625,556,173.9000244140625,557.5],["Q",167.9000244140625,559,164.4000244140625,559.5],["Q",160.9000244140625,560,156.9000244140625,560.5],["Q",152.9000244140625,561,148.9000244140625,561.5],["Q",144.9000244140625,562,142.4000244140625,562.5],["Q",139.9000244140625,563,137.9000244140625,563],["Q",135.9000244140625,563,133.4000244140625,563],["Q",130.9000244140625,563,128.4000244140625,563],["Q",125.9000244140625,563,124.4000244140625,563],["Q",122.9000244140625,563,121.4000244140625,562],["Q",119.9000244140625,561,118.9000244140625,560.5],["Q",117.9000244140625,560,117.4000244140625,560],["L",116.9000244140625,560]],"pathOffset":{"x":225.9000244140625,"y":474.5}}],"background":""}',
            ]
        ]);
    }

}
