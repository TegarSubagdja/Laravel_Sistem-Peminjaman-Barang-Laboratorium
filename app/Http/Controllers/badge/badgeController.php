<?php

namespace App\Http\Controllers\Badge;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class  BadgeController extends Controller
{
    // Path to the verticalMenu.json file
    protected $menuFilePath;

    public function __construct()
    {
        // Initialize the path in the constructor
        $this->menuFilePath = base_path('resources/menu/verticalMenu.json');
    }

    // Function to get the menu data
    public function getMenuData()
    {
        if (!File::exists($this->menuFilePath)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $jsonString = File::get($this->menuFilePath);
        $data = json_decode($jsonString, true);
        return $data;
    }

    // Function to save the menu data
    public function saveMenuData($data)
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        File::put($this->menuFilePath, $jsonData);
    }

    // Function to add a badge to a menu item
    public function addBadge($slug, $badgeType, $badgeText)
    {
        $data = $this->getMenuData();

        foreach ($data['menu'] as &$menuItem) {
            if ($menuItem['slug'] == $slug) {
                $menuItem['badge'] = [$badgeType, $badgeText];
                break;
            }
        }

        $this->saveMenuData($data);
        // return response()->json(['message' => 'Badge added successfully']);
        return redirect()->back()->with('message', 'Badge added successfully');
    }

    // Function to remove a badge from a menu item
    public function removeBadge($slug)
    {
        $data = $this->getMenuData();

        foreach ($data['menu'] as &$menuItem) {
            if ($menuItem['slug'] == $slug) {
                unset($menuItem['badge']);
                break;
            }
        }

        $this->saveMenuData($data);
        // return response()->json(['message' => 'Badge removed successfully']);
        return redirect()->back()->with('message', 'Badge removed successfully');
    }
}
