<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('product')->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.documents.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:Product Certification,User Manual',
            'issue_date' => 'required|date',
            'file' => 'required|file|mimes:pdf|max:10240',
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'product_id' => $validated['product_id'],
            'title' => $validated['title'],
            'type' => $validated['type'],
            'issue_date' => $validated['issue_date'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    public function show(Document $document)
    {
        $document->load('product');
        return view('admin.documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $products = Product::all();
        return view('admin.documents.edit', compact('document', 'products'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:Product Certification,User Manual',
            'issue_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $document->product_id = $validated['product_id'];
        $document->title = $validated['title'];
        $document->type = $validated['type'];
        $document->issue_date = $validated['issue_date'];

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($document->file_path);
            
            // Store new file
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        $document->save();

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        // Delete file from storage
        Storage::disk('public')->delete($document->file_path);
        
        $document->delete();

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document deleted successfully.');
    }

    public function download(Document $document)
    {
        // Generate PDF with metadata
        $pdf = PDF::loadView('documents.template', [
            'document' => $document,
            'product' => $document->product
        ]);
        
        return $pdf->download($document->title . '.pdf');
    }
}