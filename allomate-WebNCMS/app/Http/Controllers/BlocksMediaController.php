<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlocksMediaModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BlocksMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blocksMedia.blocks-media');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchBlocks()
    {
        $blocks = DB::select('
        SELECT pagebuilder_blocks.id, pagebuilder_blocks.title
        FROM pagebuilder_blocks 
    ');
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Block Records fetched',
            'blocks'    => $blocks
        ]);
    }
    public function getBlocksMedia()
    {
        $blocks_media = DB::select('
            SELECT blocks_media.*,pagebuilder_blocks.title as block_title,
                CASE
                    WHEN blocks_media.media_type = 1 THEN "Desktop"
                    WHEN blocks_media.media_type = 2 THEN "Tablet"
                    WHEN blocks_media.media_type = 3 THEN "Mobile"
                    ELSE "Unknown"
                END AS block_media_type_title
            FROM blocks_media
            INNER JOIN pagebuilder_blocks ON blocks_media.block_id = pagebuilder_blocks.id
        ');
        return response()->json([
            'status'            => 'success',
            'msg'               => 'Block Media Records fetched',
            'blocks_media'      =>  $blocks_media
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('media_dekstop_image')) {
            // BlocksMediaModel::where('block_id', $request->block_id)->where('media_type', 1)->delete();
            $completeFileName            =   $request->file('media_dekstop_image')->getClientOriginalName();
            $fileNameOnly                =   pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension                   =   $request->file('media_dekstop_image')->getClientOriginalExtension();
            $image                       =   str_replace(' ', '_', $fileNameOnly) . '_' . time() . '.' . $extension;
            $path                        =   $request->file('media_dekstop_image')->storeAs('public/media/', $image);
            $media_dekstop_image         =   '/storage/media/' . $image;
            $block                       =  new BlocksMediaModel();
            $block->media_url            =  $media_dekstop_image;
            $block->block_id             =  $request->block_id;
            $block->media_type           =  1;
            $block->created_at           =  Carbon::now();
            $block->created_by           =  GetActiveGuardDetail()->id;
            $block->save();
        }
        if ($request->hasFile('media_tablet_image')) {
            // BlocksMediaModel::where('block_id', $request->block_id)->where('media_type', 2)->delete();
            $completeFileName            =  $request->file('media_tablet_image')->getClientOriginalName();
            $fileNameOnly                =  pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension                   =  $request->file('media_tablet_image')->getClientOriginalExtension();
            $media_tablet_image          =  str_replace(' ', '_', $fileNameOnly) . '_' . time() . '.' . $extension;
            $path                        =  $request->file('media_tablet_image')->storeAs('public/media/', $media_tablet_image);
            $media_tablet_image          =  '/storage/media/' . $media_tablet_image;
            $block                       =  new BlocksMediaModel();
            $block->media_url            =  $media_tablet_image;
            $block->block_id             =  $request->block_id;
            $block->media_type           =  2;
            $block->created_at           =  Carbon::now();
            $block->created_by           =  GetActiveGuardDetail()->id;
            $block->save();
        }
        if ($request->hasFile('media_mobile_image')) {
            // BlocksMediaModel::where('block_id', $request->block_id)->where('media_type', 3)->delete();
            $block                       =  new BlocksMediaModel();
            $completeFileName            =  $request->file('media_mobile_image')->getClientOriginalName();
            $fileNameOnly                =  pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension                   =  $request->file('media_mobile_image')->getClientOriginalExtension();
            $media_mobile_image          =  str_replace(' ', '_', $fileNameOnly) . '_' . time() . '.' . $extension;
            $path                        =  $request->file('media_mobile_image')->storeAs('public/media/', $media_mobile_image);
            $media_mobile_image          =  '/storage/media/' . $media_mobile_image;
            $block->media_url            =  $media_mobile_image;
            $block->block_id             =  $request->block_id;
            $block->media_type           =  3;
            $block->created_at           =  Carbon::now();
            $block->created_by           =  GetActiveGuardDetail()->id;
            $block->save();
        }
        return response()->json([
            'status'            => 'success',
            'msg'               => 'Media Uploaded Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
            BlocksMediaModel::find($id)->delete();
            return response()->json([
                'status'            => 'success',
                'msg'               => 'Media deleted Successfully',
            ]);
        }
    }
}
