<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    private array $groups = ['landing', 'education', 'auth'];
    private array $types = ['hero', 'stat', 'feature', 'step', 'cta', 'fact', 'intro', 'warning', 'tip', 'brand'];

    public function index(Request $request)
    {
        $query = ContentBlock::query()->orderBy('group')->orderBy('sort_order');

        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $blocks = $query->paginate(15)->withQueryString();

        return view('admin.content.index', [
            'blocks' => $blocks,
            'groups' => $this->groups,
            'types' => $this->types,
            'filters' => $request->only(['group', 'type']),
        ]);
    }

    public function create()
    {
        return view('admin.content.form', [
            'block' => new ContentBlock(),
            'groups' => $this->groups,
            'types' => $this->types,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateBlock($request);
        ContentBlock::create($validated);

        return redirect()->route('admin.content.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(ContentBlock $content)
    {
        return view('admin.content.form', [
            'block' => $content,
            'groups' => $this->groups,
            'types' => $this->types,
        ]);
    }

    public function update(Request $request, ContentBlock $content)
    {
        $validated = $this->validateBlock($request, $content->id);
        $content->update($validated);

        return redirect()->route('admin.content.index')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(ContentBlock $content)
    {
        $content->delete();

        return redirect()->route('admin.content.index')->with('success', 'Konten berhasil dihapus.');
    }

    private function validateBlock(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'group' => 'required|in:' . implode(',', $this->groups),
            'type' => 'required|in:' . implode(',', $this->types),
            'key' => 'nullable|string|max:100',
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'meta_icon' => 'nullable|string|max:100',
            'meta_accent' => 'nullable|string|max:20',
            'meta_button_text' => 'nullable|string|max:100',
            'meta_button_url' => 'nullable|string|max:255',
            'meta_value' => 'nullable|string|max:100',
        ]);

        $meta = array_filter([
            'icon' => $validated['meta_icon'] ?? null,
            'accent' => $validated['meta_accent'] ?? null,
            'button_text' => $validated['meta_button_text'] ?? null,
            'button_url' => $validated['meta_button_url'] ?? null,
            'value' => $validated['meta_value'] ?? null,
        ]);

        return [
            'group' => $validated['group'],
            'type' => $validated['type'],
            'key' => $validated['key'] ?: null,
            'title' => $validated['title'],
            'body' => $validated['body'],
            'meta' => $meta ?: null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
