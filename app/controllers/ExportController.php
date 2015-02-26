<?php

class ExportController extends BaseController {

    public function export() {

        $result = $this->exportObject(RoleRessource::all()->toArray(), 'RoleRessource');
        $result .= $this->exportObject(Comic::all()->toArray(), 'Comic');
        $result .= $this->exportObject(Strip::all()->toArray(), 'Strip');
        $result .= $this->exportObject(Shape::all()->toArray(), 'Shape');
        $result .= $this->exportObject(Bubble::all()->toArray(), 'Bubble');
        $result .= $this->exportObject(User::all()->toArray(), 'User');

        return $result;
    }

    private function exportObject($elems, $name) {

        $blockreturn = "#### $name ####\n\n";


        foreach ($elems as $elem) {
            $blockreturn .= "$name::create([\n";
            foreach ($elem as $key => $value) {
                if (!empty($value)) {
                    $blockreturn .= "'$key' => '$value',\n";
                } else {
                    $blockreturn .= "'$key' => NULL,\n";
                }
            }
            $blockreturn .= "]);\n\n";
        }

        $blockreturn .= "\n\n";

        return $blockreturn;
    }

}
